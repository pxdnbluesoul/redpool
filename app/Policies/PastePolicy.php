<?php

namespace App\Policies;

use App\User;
use App\Paste;
use Illuminate\Auth\Access\HandlesAuthorization;

class PastePolicy extends Policy
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
        return $this->getAuthorization($user, 'Paste', $paste, 'View');
    }

    /**
     * Determine whether the user can create pastes.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Users can generally create pastes unless they meet any of a few criteria:

        // They are in a broad deny group:
        if ($user->isMemberOf('Deny Paste (Create)')) { return false; }

        // ...and that's about it, actually.
        else { return true; }
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
        return $this->getAuthorization($user, 'Paste', $paste, 'Update');
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
        return $this->getAuthorization($user, 'Paste', $paste, 'Soft Delete');
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
        return $this->getAuthorization($user, 'Paste', $paste, 'Restore');
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
        return $this->getAuthorization($user, 'Paste', $paste, 'Hard Delete');
    }
}
