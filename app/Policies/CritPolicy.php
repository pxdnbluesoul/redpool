<?php

namespace App\Policies;

use App\User;
use App\Crit;
use Illuminate\Auth\Access\HandlesAuthorization;

class CritPolicy extends Policy
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
        return $this->getAuthorization($user, 'Crit', $crit, 'View');
    }

    /**
     * Determine whether the user can create crits.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Users can generally create crits unless they meet any of a few criteria:

        // They are in a broad deny group:
        if ($user->isMemberOf('Deny Crit (Create)')) { return false; }

        // ...and that's about it, actually.
        else { return true; }
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
        return $this->getAuthorization($user, 'Crit', $crit, 'Update');
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
        return $this->getAuthorization($user, 'Crit', $crit, 'Soft Delete');
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
        return $this->getAuthorization($user, 'Crit', $crit, 'Restore');
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
        return $this->getAuthorization($user, 'Crit', $crit, 'Hard Delete');
    }
}
