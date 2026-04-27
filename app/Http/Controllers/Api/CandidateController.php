<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Candidate;

class CandidateController extends Controller
{
    public function create(Request $request, Candidate $candidate)
    {
        $data = $candidate->saveCandidate($request);
        return response()->json([
            'message' => 'Save Success',
            'data' => $data
        ], 200);
    }

    public function list(Request $request)
    {
        $keyword = $request->keyword;
        $query = Candidate::leftJoin('candidate_categories', 'candidate_categories.id', '=', 'candidates.candidate_category_id');
        if ($keyword == "") {
            $data = $query->orderBy('candidates.id', 'DESC')->get([
                'candidates.id',
                'candidates.name',
                'candidates.candidate_category_id',
                'candidate_categories.name as category_name',
                'candidates.age',
                'candidates.birth_date',
                'candidates.german_level',
                'candidates.avatar',
                'candidates.created_at'
            ]);
        } else {
            $data = $query->where('candidates.name', 'LIKE', '%' . $keyword . '%')
                ->orderBy('candidates.id', 'DESC')
                ->get([
                    'candidates.id',
                    'candidates.name',
                    'candidates.candidate_category_id',
                    'candidate_categories.name as category_name',
                    'candidates.age',
                    'candidates.birth_date',
                    'candidates.german_level',
                    'candidates.avatar',
                    'candidates.created_at'
                ]);
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }

    public function delete($id)
    {
        $query = Candidate::find($id);
        if ($query) {
            if ($query->avatar) {
                $avatarPath = str_replace('http://localhost:8080', '', $query->avatar);
                $avatarFile = public_path() . $avatarPath;
                if (file_exists(public_path() . $avatarPath)) {
                    \File::delete($avatarFile);
                }
            }
            if ($query->graduation_image) {
                $degreePath = str_replace('http://localhost:8080', '', $query->graduation_image);
                $degreeFile = public_path() . $degreePath;
                if (file_exists(public_path() . $degreePath)) {
                    \File::delete($degreeFile);
                }
            }
            $query->delete();
        }
        return response()->json(['message' => 'Delete Success'], 200);
    }

    public function edit($id)
    {
        $data = Candidate::where([
            'id' => $id
        ])->first();
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
}
