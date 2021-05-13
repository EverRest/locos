<?php

namespace App\Providers;

use App\Contracts\IAccidentRepository;
use App\Contracts\ICommentRepository;
use App\Contracts\IPetRepository;
use App\Contracts\IPostRepository;
use App\Repositories\AccidentRepository;
use App\Repositories\CommentRepository;
use App\Repositories\PetRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IAccidentRepository::class, AccidentRepository::class);
        $this->app->singleton(IPetRepository::class, PetRepository::class);
        $this->app->singleton(ICommentRepository::class, CommentRepository::class);
        $this->app->singleton(IPostRepository::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
