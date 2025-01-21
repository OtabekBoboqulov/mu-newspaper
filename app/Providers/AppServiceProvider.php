<?php

namespace App\Providers;

use App\Models\Post;
use Illuminate\Support\Facades\View;
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
        // Share unpublished posts count with the layout
        View::composer('components.layout', function ($view) {
            $unpublishedPostsCount = Post::where('published', false)->count();
            $view->with('unpublishedPostsCount', $unpublishedPostsCount);
        });
    }
}
