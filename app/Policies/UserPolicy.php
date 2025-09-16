<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $role = $user->getRoleNames()->first();
        $profile = $user->profile;

        // Jika tidak ada profil atau wilayah, langsung tolak
        if (!$profile || !$profile->wilayah) {
            return false;
        }

        $tingkatWilayah = $profile->wilayah->tingkat_wilayah;

        // Admin pusat bisa menambah semua user
        if ($role === 'Admin') {
            return true;
        }

        // Admin Provinsi hanya bisa menambah Operator Provinsi dan Admin Kabupaten
        if ($role === 'Admin Provinsi' && $tingkatWilayah === 1) {
            return true;
        }

        // Admin Kabupaten hanya bisa menambah Operator Kabupaten
        if ($role === 'Admin Kabupaten' && $tingkatWilayah === 2) {
            return true;
        }

        // Role lainnya ditolak
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $currentUser, User $userToEdit)
    {
        $currentRole = $currentUser->getRoleNames()->first();

        if (in_array($currentRole, ['Admin Provinsi', 'Operator Provinsi'])) {
            return $currentUser->profile->wilayah->kode_pro === $userToEdit->profile->wilayah->kode_pro;
        }

        if (in_array($currentRole, ['Admin Kabupaten', 'Operator Kabupaten'])) {
            return $currentUser->profile->wilayah_id === $userToEdit->profile->wilayah_id;
        }

        // Admin pusat bebas
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, User $model)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, User $model)
    {
        //
    }
}
