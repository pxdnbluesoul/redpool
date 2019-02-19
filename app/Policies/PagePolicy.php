<?php

namespace App\Policies;

use App\User;
use App\Page;
use Illuminate\Auth\Access\HandlesAuthorization;

class PagePolicy extends Policy
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
        return $this->getAuthorization($user, 'Page', $page, 'View');
    }

    /**
     * Determine whether the user can create pages.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Users can generally create pages unless they meet any of a few criteria:

        // They are in a broad deny group:
        if ($user->isMemberOf('Deny Page (Create)')) { return false; }

        // ...and that's about it, actually.
        else { return true; }
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
        return $this->getAuthorization($user, 'Page', $page, 'Update');
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
        return $this->getAuthorization($user, 'Page', $page, 'Soft Delete');
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
        return $this->getAuthorization($user, 'Page', $page, 'Restore');
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
        return $this->getAuthorization($user, 'Page', $page, 'Hard Delete');
    }
}
