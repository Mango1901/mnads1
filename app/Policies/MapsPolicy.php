<?php

namespace App\Policies;

use App\Maps;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MapsPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Maps  $maps
     * @return mixed
     */
    public function view(User $user, Maps $maps)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->roles == 1){
            $check_maps_number = Maps::where('user_id',$user->id)->where('status',0)->count();
            return $check_maps_number < 10;
        }elseif($user->roles == 0) {
            $check_maps_number = Maps::where('user_id', $user->id)->where('status', 0)->count();
            return $check_maps_number < 1;
        }else{
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Maps  $maps
     * @return mixed
     */
    public function update(User $user, Maps $maps)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Maps  $maps
     * @return mixed
     */
    public function delete(User $user, Maps $maps)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Maps  $maps
     * @return mixed
     */
    public function restore(User $user, Maps $maps)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Maps  $maps
     * @return mixed
     */
    public function forceDelete(User $user, Maps $maps)
    {
        //
    }
}
