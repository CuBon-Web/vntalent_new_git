<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HomeChooseSetting extends Model
{
    protected $table = 'home_choose_settings';

    protected $fillable = [
        'tagline',
        'title',
        'title_highlight',
        'description',
        'image_1',
        'image_2',
        'image_shape',
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
            'title_highlight' => $request->title_highlight,
            'description' => $request->description,
            'image_1' => $request->image_1,
            'image_2' => $request->image_2,
            'image_shape' => $request->image_shape,
        ]);
        $row->save();

        return $row;
    }
}
