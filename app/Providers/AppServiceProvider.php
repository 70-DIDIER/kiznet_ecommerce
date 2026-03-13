<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\SiteInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrap();
        // view()->composer('*', function ($view) {
        //     $viewName = $view->getName();
        //     if (!str_starts_with($viewName, 'admin.')) {
        //         $view->with('categories', Category::all());
        //         $view->with('siteInfos', SiteInfo::pluck('value', 'key')->toArray());
        //     }
        // });
    }
}
