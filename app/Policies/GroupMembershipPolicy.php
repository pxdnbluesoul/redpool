<?php

namespace App\Policies;

use App\User;
use App\GroupMembership;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupMembershipPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the group membership.
     *
     * @param  \App\User  $user
     * @param  \App\GroupMembership  $groupMembership
     * @return mixed
     */
    public function view(User $user, GroupMembership $groupMembership)
    {
        return $this->getAuthorization($user, 'User', $groupMembership, 'View');
    }

    /**
     * Determine whether the user can create group memberships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Users can generally NOT create group memberships unless they meet any of a few criteria:

        // They are in a broad allow group:
        if ($user->isMemberOf('Allow Group Membership (Create)')) { return true; }

        // ...and that's about it, actually.
        else { return false; }
    }

    /**
     * Determine whether the user can update the group membership.
     *
     * @param  \App\User  $user
     * @param  \App\GroupMembership  $groupMembership
     * @return mixed
     */
    public function update(User $user, GroupMembership $groupMembership)
    {
        return $this->getAuthorization($user, 'User', $groupMembership, 'Update');
    }

    /**
     * Determine whether the user can delete the group membership.
     *
     * @param  \App\User  $user
     * @param  \App\GroupMembership  $groupMembership
     * @return mixed
     */
    public function delete(User $user, GroupMembership $groupMembership)
    {
        return $this->getAuthorization($user, 'User', $groupMembership, 'Soft Delete');
    }

    /**
     * Determine whether the user can restore the group membership.
     *
     * @param  \App\User  $user
     * @param  \App\GroupMembership  $groupMembership
     * @return mixed
     */
    public function restore(User $user, GroupMembership $groupMembership)
    {
        return $this->getAuthorization($user, 'User', $groupMembership, 'Restore');
    }

    /**
     * Determine whether the user can permanently delete the group membership.
     *
     * @param  \App\User  $user
     * @param  \App\GroupMembership  $groupMembership
     * @return mixed
     */
    public function forceDelete(User $user, GroupMembership $groupMembership)
    {
        return $this->getAuthorization($user, 'User', $groupMembership, 'Hard Delete');
    }
}
