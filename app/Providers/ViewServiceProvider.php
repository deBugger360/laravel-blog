<?php

namespace App\Providers;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('blog.partials._header', function ($view) {
            $categories = Category::select('name')->distinct()->pluck('name');
            $view->with('categories', $categories);
        });

        View::composer('blog.partials._footer', function ($view) {
            $categories = Category::select('name')->distinct()->pluck('name');
            $view->with('categories', $categories);
        });
    }
}
