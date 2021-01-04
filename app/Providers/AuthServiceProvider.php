<?php

namespace App\Providers;

use App\Call;
use App\ChatFaceBook;
use App\ChatZalo;
use App\Contact;
use App\GoogleLogin;
use App\Maps;
use App\Policies\CallPolicy;
use App\Policies\ChatFaceBookPolicy;
use App\Policies\ChatZaloPolicy;
use App\Policies\ContactPolicy;
use App\Policies\MapsPolicy;
use App\Social;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Call::class => CallPolicy::class,
        ChatFaceBook::class => ChatFaceBookPolicy::class,
        ChatZalo::class => ChatZaloPolicy::class,
        Contact::class => ContactPolicy::class,
        Maps::class => MapsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::define('is-admin',function ($user){
            return $user->roles === 2;
        });

    }
}
