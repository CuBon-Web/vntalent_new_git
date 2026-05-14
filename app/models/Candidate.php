<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = "candidates";

    public function saveCandidate($request)
    {
        $id = $request->id;
        if ($id != "") {
            $query = Candidate::where([
                'id' => $id
            ])->first();

            if (!$query) {
                $query = new Candidate();
            }
        } else {
            $query = new Candidate();
        }

        $query->name = $request->name;
        $query->candidate_category_id = $request->candidate_category_id;
        $query->birth_date = $request->birth_date;
        $query->age = $request->age;
        $query->gender = $request->gender !== null && $request->gender !== '' ? (int) $request->gender : null;
        $query->german_level = $request->german_level;
        $query->avatar = $request->avatar;
        $query->graduation_image = $request->graduation_image;
        $other = $request->input('other_documents');
        if (is_array($other)) {
            $query->other_documents = json_encode(array_values(array_filter($other)));
        } elseif (is_string($other) && $other !== '') {
            $query->other_documents = $other;
        } else {
            $query->other_documents = null;
        }
        $query->short_bio = $request->short_bio;
        $query->video_url = $request->video_url;
        $query->status = $request->status;
        $query->save();

        return $query;
    }
}
