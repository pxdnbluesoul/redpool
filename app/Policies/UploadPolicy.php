<?php

namespace App\Policies;

use App\User;
use App\Upload;
use Illuminate\Auth\Access\HandlesAuthorization;

class UploadPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the upload.
     *
     * @param  \App\User  $user
     * @param  \App\Upload  $upload
     * @return mixed
     */
    public function view(User $user, Upload $upload)
    {
        return $this->getAuthorization($user, 'Upload', $upload, 'View');
    }

    /**
     * Determine whether the user can create uploads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        // Users can generally create uploads unless they meet any of a few criteria:

        // They are in a broad deny group:
        if ($user->isMemberOf('Deny Upload (Create)')) { return false; }

        // ...and that's about it, actually.
        else { return true; }
    }

    /**
     * Determine whether the user can update the upload.
     *
     * @param  \App\User  $user
     * @param  \App\Upload  $upload
     * @return mixed
     */
    public function update(User $user, Upload $upload)
    {
        return $this->getAuthorization($user, 'Upload', $upload, 'Update');
    }

    /**
     * Determine whether the user can delete the upload.
     *
     * @param  \App\User  $user
     * @param  \App\Upload  $upload
     * @return mixed
     */
    public function delete(User $user, Upload $upload)
    {
        return $this->getAuthorization($user, 'Upload', $upload, 'Soft Delete');
    }

    /**
     * Determine whether the user can restore the upload.
     *
     * @param  \App\User  $user
     * @param  \App\Upload  $upload
     * @return mixed
     */
    public function restore(User $user, Upload $upload)
    {
        return $this->getAuthorization($user, 'Upload', $upload, 'Restore');
    }

    /**
     * Determine whether the user can permanently delete the upload.
     *
     * @param  \App\User  $user
     * @param  \App\Upload  $upload
     * @return mixed
     */
    public function forceDelete(User $user, Upload $upload)
    {
        return $this->getAuthorization($user, 'Upload', $upload, 'Hard Delete');
    }
}
