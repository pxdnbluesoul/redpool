<?php

namespace App\Policies;
use App\User;

class Policy
{
    # The getAuthorization method drives all authorization for our RBAC system.
    # It expects a few things.
    # - The object must have a getMetadata() method or it will throw an exception.
    # - You wish for the creator of an object to be permitted to hard-delete their own object.
    #   (You can override that behavior with the optional 5th argument $no_user_rights = true).
    # - The $object_type needs to match the class name for group memberships to be correctly looked up or it will,
    #   you guessed it, throw an exception.
    # Returns true or false.

    public function getAuthorization(User $user, string $object_type, $object, string $access_level, bool $no_user_rights = false)
    {
        // First let's make sure we receive a valid access level type from the list.
        // Create is handled differently and should not be passed to this method.
        $access_level = ucwords($access_level);
        if (!in_array($access_level, ['View', 'Update', 'Soft Delete', 'Restore', 'Hard Delete']))
        {
            // Fail safe.
            throw new \UnexpectedValueException('Invalid Access Level Passed');
        }

        // Then, let's make sure the $object we received has the getMetadata method and kick it back if not.
        if (!method_exists($object, 'getMetadata'))
        {
            throw new \BadMethodCallException('Object passed does not possess getMetadata method.');
        }

        // If it's gotten this far, it's good enough to get started with.

        // DENY RULES

        // Broadly denied members can't do anything. Disabled members inherit all deny rules.
        if ($user->isMemberOf('Deny '.$object_type.' ('.$access_level.')')) { return false; }

        // Look for explicit deny rules in the object's metadata.
        try {
            $blockedusers = $object->getMetadata('Deny Users ('.$access_level.')');
            if (in_array($user->id, $blockedusers)) { return false; }

            $blockedgroups = $object->getMetadata('Deny Groups ('.$access_level.')');
            $usergroups = $user->getMetadata('Group IDs');

            // Any overlap means the deny takes precedence.
            if (boolval(array_intersect($blockedgroups, $usergroups))) { return false; };
        }
        catch (\OutOfBoundsException $e) { /* No metadata here is common, carry on. */ }

        // ALLOW RULES

        // A user can work with an object they created, unless we have specified that for this instance they cannot.
        // Note we are not returning false on no_user_rights being present, just that they must receive the true
        // by some other means.
        if ($object->user_id == $user->id && $no_user_rights != true) { return true; }
        // Edge case for user objects as they don't have a user_id field.
        if ($object_type == 'User' && $object->id == $user->id && $no_user_rights != true) { return true; }

        // Check for membership in an explicit allow group.
        if ($user->isMemberOf('Allow '.$object_type.' ('.$access_level.')')) { return true; }

        // If none of the above apply, let's look for overrides in the object's metadata.
        else {
            try {
                $allowedusers = $object->getMetadata('Allow Users ('.$access_level.')');
                if (in_array($user->id, $allowedusers)) {
                    // If the user is explicitly allowed it, allow it.
                    return true;
                }

                $allowedgroups = $object->getMetadata('Allow Groups ('.$access_level.')');
                $usergroups = $user->getMetadata('Group IDs');

                // If there is overlap between allowedgroups and the user's group memberships, allow it, otherwise deny it.
                return boolval(array_intersect($allowedgroups, $usergroups));
            }
                // Lastly, If they're not a member of any groups and didn't make the page, or did make the page but
                // $no_user_rights was set to true and didn't otherwise qualify for an allow, deny.
            catch (\OutOfBoundsException $e) { return false; }
        }
    }
}