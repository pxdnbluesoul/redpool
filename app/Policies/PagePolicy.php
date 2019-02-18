<?php

namespace App\Policies;

use App\User;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function view(User $user, Page $page)
    {
        // DENY RULES

        // Disabled users can't do anything. (Explicit Deny)
        if ($user->isMemberOf('Disabled')) { return false; }

        // Look for explicit deny rules in the page metadata.
        try {
            $blockedusers = $page->getMetadata('blocked_users');
            if (in_array($user->id, $blockedusers)) { return false; }

            $blockedgroups = $page->getMetadata('blocked_groups');
            $usergroups = $user->getMetadata('group_ids');

            // Any overlap means the deny takes precedence.
            if (boolval(array_intersect($blockedgroups, $usergroups))) { return false; };
        }
        catch (\OutOfBoundsException $e) { /* No metadata here is common, carry on. */ }

        // ALLOW RULES

        // A user can view a page they created.
        if ($page->user_id == $user->id) { return true; }

        // Then we inherit the standard Page Viewers permission.
        if ($user->isMemberOf('Page Viewers')) { return true; }

        // If none of the above apply, let's look for overrides in the page metadata.
        else {
            try {
                $viewusers = $page->getMetadata('view_users');
                if (in_array($user->id, $viewusers)) {
                    // If the user is explicitly allowed it, allow it.
                    return true;
                }

                $viewgroups = $page->getMetadata('view_groups');
                $usergroups = $user->getMetadata('group_ids');

                // If there is overlap between view_groups and the user's group memberships, allow it, otherwise deny it.
                return boolval(array_intersect($viewgroups, $usergroups));
            }
            // Lastly, If they're not a member of any groups and didn't make the page, deny.
            catch (\OutOfBoundsException $e) { return false; }
        }
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return !$user->isMemberOf('Disabled');
    }

    /**
     * Determine whether the user can update the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function update(User $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can delete the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function delete(User $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can restore the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function restore(User $user, Page $page)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the page.
     *
     * @param  \App\User  $user
     * @param  \App\Page  $page
     * @return mixed
     */
    public function forceDelete(User $user, Page $page)
    {
        //
    }
}
