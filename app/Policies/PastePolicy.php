<?php

namespace App\Policies;

use App\User;
use App\Paste;
use Illuminate\Auth\Access\HandlesAuthorization;

class PastePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the paste.
     *
     * @param  \App\User  $user
     * @param  \App\Paste  $paste
     * @return mixed
     */
    public function view(User $user, Paste $paste)
    {
        //
    }

    /**
     * Determine whether the user can create pastes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the paste.
     *
     * @param  \App\User  $user
     * @param  \App\Paste  $paste
     * @return mixed
     */
    public function update(User $user, Paste $paste)
    {
        //
    }

    /**
     * Determine whether the user can delete the paste.
     *
     * @param  \App\User  $user
     * @param  \App\Paste  $paste
     * @return mixed
     */
    public function delete(User $user, Paste $paste)
    {
        //
    }

    /**
     * Determine whether the user can restore the paste.
     *
     * @param  \App\User  $user
     * @param  \App\Paste  $paste
     * @return mixed
     */
    public function restore(User $user, Paste $paste)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the paste.
     *
     * @param  \App\User  $user
     * @param  \App\Paste  $paste
     * @return mixed
     */
    public function forceDelete(User $user, Paste $paste)
    {
        //
    }
}
