<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {

        // //every time the my_menu view is rendered, this callback will be called
        // View::composer('loginfrom', function( $view )
        // {
        //     $data = Auth::user()//get your data here

        //     //pass the data to the view
        //     $view->with( 'data', $data );
        // } );

        // Using class based composers...
        view()->composer(
            'layout.profile', 'App\Http\ViewComposers\ProfileComposer'
        );
        view()->composer(
            'admin_user_layout', 'App\Http\ViewComposers\ProfileComposer'
        );
        view()->composer(
            'admin_layout', 'App\Http\ViewComposers\ProfileComposer'
        );

        // Using Closure based composers...
        view()->composer('dashboard', function ($view) {

        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
