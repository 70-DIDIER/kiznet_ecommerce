<?php

use App\Models\SiteInfo;

if (!function_exists('site_info')) {
    /**
     * Récupérer une information du site
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    function site_info(string $key, $default = null)
    {
        return SiteInfo::get($key, $default);
    }
}