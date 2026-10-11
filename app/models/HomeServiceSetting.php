<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HomeServiceSetting extends Model
{
    protected $table = 'home_service_settings';

    protected $fillable = [
        'tagline',
        'title',
        'description',
        'button_text',
        'button_link',
    ];

    public static function current()
    {
        return self::first() ?: new self();
    }

    public static function saveSetting($request)
    {
        $row = self::first() ?: new self();
        $row->fill([
            'tagline' => $request->tagline,
            'title' => $request->title,
            'description' => $request->description,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
        ]);
        $row->save();

        return $row;
    }
}
