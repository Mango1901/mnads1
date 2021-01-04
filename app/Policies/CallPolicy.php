<?php

namespace App\Policies;

use App\Call;
use App\User;
use http\Env\Request;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CallPolicy
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
     * @param  \App\Call  $call
     * @return mixed
     */
    public function view(User $user, Call $call)
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
            $check_call_number = Call::where('user_id',$user->id)->where('status',0)->count();
            return $check_call_number < 10;
        }elseif($user->roles == 0) {
            $check_call_number = Call::where('user_id', $user->id)->where('status', 0)->count();
            return $check_call_number < 1;
        }else{
            return true;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function update(User $user, Call $call)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function delete(User $user, Call $call)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function restore(User $user, Call $call)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Call  $call
     * @return mixed
     */
    public function forceDelete(User $user, Call $call)
    {
        //
    }
}
