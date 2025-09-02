<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\SendNewLetter;
use Illuminate\Auth\Access\HandlesAuthorization;

class SendNewLetterPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view any models.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->can('view_any_send::new::letter');
    }

    /**
     * Determine whether the admin can view the model.
     */
    public function view(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('view_send::new::letter');
    }

    /**
     * Determine whether the admin can create models.
     */
    public function create(Admin $admin): bool
    {
        return $admin->can('create_send::new::letter');
    }

    /**
     * Determine whether the admin can update the model.
     */
    public function update(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('update_send::new::letter');
    }

    /**
     * Determine whether the admin can delete the model.
     */
    public function delete(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('delete_send::new::letter');
    }

    /**
     * Determine whether the admin can bulk delete.
     */
    public function deleteAny(Admin $admin): bool
    {
        return $admin->can('delete_any_send::new::letter');
    }

    /**
     * Determine whether the admin can permanently delete.
     */
    public function forceDelete(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('force_delete_send::new::letter');
    }

    /**
     * Determine whether the admin can permanently bulk delete.
     */
    public function forceDeleteAny(Admin $admin): bool
    {
        return $admin->can('force_delete_any_send::new::letter');
    }

    /**
     * Determine whether the admin can restore.
     */
    public function restore(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('restore_send::new::letter');
    }

    /**
     * Determine whether the admin can bulk restore.
     */
    public function restoreAny(Admin $admin): bool
    {
        return $admin->can('restore_any_send::new::letter');
    }

    /**
     * Determine whether the admin can replicate.
     */
    public function replicate(Admin $admin, SendNewLetter $sendNewLetter): bool
    {
        return $admin->can('replicate_send::new::letter');
    }

    /**
     * Determine whether the admin can reorder.
     */
    public function reorder(Admin $admin): bool
    {
        return $admin->can('reorder_send::new::letter');
    }
}
