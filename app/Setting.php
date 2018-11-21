<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class Setting extends Model
{
    protected $primaryKey = 'name';

    /**
     * Prevent laravel to automatically casting the primary key to integer.
     * We know our primary key is string.
     */
    public $incrementing = false;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'value',
    ];

    public $timestamps = false;

    /**
     * Get value of a setting
     *
     * @param setting_name string
     * @return string
     */
    public static function value($setting_name)
    {
        try
        {
            $setting = self::findOrFail($setting_name);
        }
        catch (ModelNotFoundException $exception)
        {
            abort(500, "Setting '$setting_name' is not exists in settings table");
        }

        // if setting found, return the value
        return $setting->value;
    }

    /**
     * Update value of a setting
     *
     * @param setting_name string
     * @return void
     */
    public static function change($setting_name, $value)
    {
        $setting = Self::find($setting_name);
        $setting->update(['value' => $value]);
    }
}
