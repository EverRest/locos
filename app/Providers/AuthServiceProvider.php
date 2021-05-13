<?php

namespace App\Providers;

use App\Models\Accident;
use App\Models\Comment;
use App\Models\Pet;
use App\Models\Post;
use App\Policies\AccidentPolicy;
use App\Policies\CommentPolicy;
use App\Policies\PetPolicy;
use App\Policies\PostPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Models\Model' => 'App\Policies\ModelPolicy',
        Accident::class => AccidentPolicy::class,
        Pet::class => PetPolicy::class,
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!$this->app->routesAreCached()) {
            Passport::routes();
        }
    }
}
