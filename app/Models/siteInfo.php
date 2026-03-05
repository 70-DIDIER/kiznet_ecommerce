<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiteInfo extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key',
        'value',
        'type',
    ];

    /**
     * Récupérer une valeur par sa clé
     */
    public static function get(string $key, $default = null)
    {
        $info = self::where('key', $key)->first();
        return $info ? $info->value : $default;
    }

    /**
     * Définir ou mettre à jour une valeur
     */
    public static function set(string $key, $value, string $type = 'text')
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => $type]
        );
    }
}