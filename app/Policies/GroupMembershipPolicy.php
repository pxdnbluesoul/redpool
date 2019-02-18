<?php

namespace App\Policies;

use App\User;
use App\GroupMembership;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupMembershipPolicy
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
        //
    }

    /**
     * Determine whether the user can create group memberships.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
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
        //
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
        //
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
        //
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
        //
    }
}
