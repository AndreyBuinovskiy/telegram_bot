<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Setting
 *
 * @property string $key
 * @property string $value
 * @property int $serialized
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereSerialized($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Setting whereValue($value)
 * @mixin \Eloquent
 */
class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function getSettings($key = null)
    {
        $settings = $key ? self::where('key', $key)->first() : self::get();

        $collect = collect();
        foreach ($settings as $setting) {
            $collect->put($setting->key, $setting->value);
        }

        return $collect;
    }
}
