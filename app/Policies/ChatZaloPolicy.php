<?php

namespace App\Policies;

use App\ChatZalo;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChatZaloPolicy
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
     * @param  \App\ChatZalo  $chatZalo
     * @return mixed
     */
    public function view(User $user, ChatZalo $chatZalo)
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
            $check_chat_zalo = ChatZalo::where('user_id',$user->id)->where('status',0)->count();
            return $check_chat_zalo < 10;
        }elseif($user->roles == 0) {
            $check_chat_zalo = ChatZalo::where('user_id', $user->id)->where('status', 0)->count();
            return $check_chat_zalo < 1;
        }else{
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\ChatZalo  $chatZalo
     * @return mixed
     */
    public function update(User $user, ChatZalo $chatZalo)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ChatZalo  $chatZalo
     * @return mixed
     */
    public function delete(User $user, ChatZalo $chatZalo)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\ChatZalo  $chatZalo
     * @return mixed
     */
    public function restore(User $user, ChatZalo $chatZalo)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\ChatZalo  $chatZalo
     * @return mixed
     */
    public function forceDelete(User $user, ChatZalo $chatZalo)
    {
        //
    }
}
