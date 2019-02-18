<?php

namespace App\Policies;

use App\User;
use App\Crit;
use Illuminate\Auth\Access\HandlesAuthorization;

class CritPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the crit.
     *
     * @param  \App\User  $user
     * @param  \App\Crit  $crit
     * @return mixed
     */
    public function view(User $user, Crit $crit)
    {
        //
    }

    /**
     * Determine whether the user can create crits.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the crit.
     *
     * @param  \App\User  $user
     * @param  \App\Crit  $crit
     * @return mixed
     */
    public function update(User $user, Crit $crit)
    {
        //
    }

    /**
     * Determine whether the user can delete the crit.
     *
     * @param  \App\User  $user
     * @param  \App\Crit  $crit
     * @return mixed
     */
    public function delete(User $user, Crit $crit)
    {
        //
    }

    /**
     * Determine whether the user can restore the crit.
     *
     * @param  \App\User  $user
     * @param  \App\Crit  $crit
     * @return mixed
     */
    public function restore(User $user, Crit $crit)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the crit.
     *
     * @param  \App\User  $user
     * @param  \App\Crit  $crit
     * @return mixed
     */
    public function forceDelete(User $user, Crit $crit)
    {
        //
    }
}
