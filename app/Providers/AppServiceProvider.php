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

        view()->composer(['layouts.app', 'layouts.header', 'layouts.footer'], function ($view) {
            static $siteInfos = null;
            if ($siteInfos === null) {
                $siteInfos = SiteInfo::pluck('value', 'key')->toArray();
            }
            $view->with('siteInfos', $siteInfos);
        });
    }
}
