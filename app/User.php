<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','metadata','wikidotusername'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function memberships()
    {
        return $this->morphMany('App\GroupMembership', 'member');
    }

    public $flattenedpermissions = [];

    public $groupmemberships = [];

    public function recursememberships()
    {
        # So we get an array of GroupMembership objects from a User with the memberships() method.
        # These memberships can be chained arbitrarily deep. Global Admin is a member of Upload Admins,
        # which is a member of Upload users, which is a member of Users, and so on.
        #
        # These are expensive N+1 calculations so we will store the results in the user's metadata field and update
        # only when necessary.
        #
        # We will take the user object, and get it's directly connected memberships.
        # For each of those, we will add their ids to flattenedpermissions.
        # Then we'll take them and look for any sub-memberships via the recurse() function which calls itself.
        # This will go an arbitrary number of levels deep.
        # Finally, we will take the flattenedpermissions and groupmemberships properties and save them in user metadata.

        $groups = $this->memberships()->get(); // returns a collection whether or not there are any memberships.

        if ($groups->isEmpty()) { return null; }

        else {
            foreach ($groups as $group) {
                if(!in_array($group->group_id, $this->flattenedpermissions)) {
                    $this->flattenedpermissions[] = $group->group_id;
                }
                $result = $this->recurse($group->group_id);
                if ($result == null) { continue; }
            }
            // Get names from IDs and save.
            $groupcollection = Group::whereIn('id',$this->flattenedpermissions)->pluck('name');
            foreach ($groupcollection as $g) { $this->groupmemberships[] = $g; }

            // Pull existing metadata, update, and save.
            $metadata = json_decode($this->metadata, true);
            $metadata['Group IDs'] = $this->flattenedpermissions;
            $metadata['Group Names'] = $this->groupmemberships;
            $this->metadata = json_encode($metadata);
            $this->save();

            // Fin.
            return $this->flattenedpermissions;

        }
    }

    public function recurse($group) {
        $groups = Group::find($group)->memberships()->get(); // returns a collection whether or not there are any memberships.
        if ($groups->isEmpty()) { return null; }
        else {
            foreach ($groups as $group2) {
                if(!in_array($group2->member_id, $this->flattenedpermissions)) {
                    $this->flattenedpermissions[] = $group2->member_id;
                }
                // Try again with the next level down.
                $result = $this->recurse($group2->member_id);
                if ($result == null) { continue; }
            }
            return true;
        }
    }

    // Pull a metadata field by key and return it in php-friendly format.
    // May be any of the json types on return.
    // Throws an OutOfBoundsException on no matching key since JSON could return null, false, 0, etc.
    public function getMetadata(string $key)
    {
        $metadata = json_decode($this->metadata, true);
        if(!array_key_exists($key, $metadata)) { throw new \OutOfBoundsException("Key not present in metadata."); }
        else { return $metadata[$key]; }
    }

    // Update a single metadata field.
    // Requires the key to look up and an arbitrary value to set, but needs to be a JSON-convertible type.
    // So int, bool, string, array, null, or object (nested array).
    // You may also pass the force parameter true to skip looking up the existence of the key in metadata.
    public function setMetadata(string $key, $value, bool $force = false)
    {
        $metadata = json_decode($this->metadata, true);
        if ($force == false) { if(!array_key_exists($key, $metadata)) {
            throw new \OutOfBoundsException("Key not present in metadata."); }
        }
        $metadata[$key] = $value;
        $this->metadata = json_encode($metadata);
        $this->save();
        return true;
    }

    // Return a true or false on group membership.
    public function isMemberOf(string $name)
    {
        $metadata = json_decode($this->metadata, true);
        if(!array_key_exists('Group Names', $metadata)) { return false; } // User has no memberships.
        return in_array($name, $metadata['Group Names']);
    }


    // Return true or false on group membership given an array of possible groups.
    public function isMemberOfAny(array $groups)
    {
        $metadata = json_decode($this->metadata, true);
        if(!array_key_exists('Group Names', $metadata)) { return false; } // User has no memberships.

        // If there is any overlap between the provided groups and the user metadata, return true. If not return false.
        return boolval(array_intersect($groups, $metadata['Group Names']));
    }
}
