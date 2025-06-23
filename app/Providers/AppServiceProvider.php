<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Model::preventLazyLoading(!app()->isProduction());
//        Gate::policy(Author::class, \App\Policies\Blog\AuthorPolicy::class);
//        Gate::policy(\Ramnzys\FilamentEmailLog\Models\Email::class, \App\Policies\EmailPolicy::class);
    }

}
