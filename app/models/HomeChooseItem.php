<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HomeChooseItem extends Model
{
    protected $table = 'home_choose_items';

    protected $fillable = [
        'title',
        'description',
        'icon',
        'sort_order',
        'status',
    ];

    public function saveItem($request)
    {
        $id = $request->id ?? null;
        $payload = [
            'title' => $request->title,
            'description' => $request->description ?? '',
            'icon' => $request->icon ?? '',
            'sort_order' => (int) ($request->sort_order ?? 0),
            'status' => (int) ($request->status ?? 1),
        ];

        if ($id && ($row = self::find($id))) {
            $row->fill($payload);
            $row->save();

            return $row;
        }

        $row = new self();
        $row->fill($payload);
        $row->save();

        return $row;
    }
}
