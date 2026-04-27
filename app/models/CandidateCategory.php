<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CandidateCategory extends Model
{
    protected $table = "candidate_categories";

    public function saveCategory($request)
    {
        $id = $request->id;
        if ($id != "") {
            $query = CandidateCategory::where([
                'id' => $id
            ])->first();
            if (!$query) {
                $query = new CandidateCategory();
            }
        } else {
            $query = new CandidateCategory();
        }

        $query->name = $request->name;
        $query->status = $request->status;
        $query->save();

        return $query;
    }
}
