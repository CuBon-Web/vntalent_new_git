<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HomeProcessSetting extends Model
{
    protected $table = 'home_process_settings';

    protected $fillable = [
        'tagline',
        'title',
        'description',
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
        ]);
        $row->save();

        return $row;
    }
}
