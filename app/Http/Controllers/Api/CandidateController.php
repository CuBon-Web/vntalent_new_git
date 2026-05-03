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
        $keyword = $request->input('keyword', '');
        $query = Candidate::leftJoin('candidate_categories', 'candidate_categories.id', '=', 'candidates.candidate_category_id');

        if ($request->filled('candidate_category_id')) {
            $query->where('candidates.candidate_category_id', (int) $request->candidate_category_id);
        }

        $ageRange = $request->input('age_range');
        if ($ageRange === '18-22') {
            $query->whereBetween('candidates.age', [18, 22]);
        } elseif ($ageRange === '23-27') {
            $query->whereBetween('candidates.age', [23, 27]);
        } elseif ($ageRange === '28-32') {
            $query->whereBetween('candidates.age', [28, 32]);
        } elseif ($ageRange === '32-36') {
            $query->whereBetween('candidates.age', [32, 36]);
        } elseif ($ageRange === '37+') {
            $query->where('candidates.age', '>=', 37);
        }

        $germanLevel = $request->input('german_level');
        if ($germanLevel !== null && $germanLevel !== '') {
            $levels = is_array($germanLevel) ? $germanLevel : [$germanLevel];
            $levels = array_values(array_filter($levels, function ($v) {
                return $v !== null && $v !== '';
            }));
            if (count($levels)) {
                $query->whereIn('candidates.german_level', $levels);
            }
        }

        if ($request->filled('gender') && in_array((string) $request->gender, ['1', '2'], true)) {
            $query->where('candidates.gender', (int) $request->gender);
        }

        if ($keyword !== '') {
            $query->where('candidates.name', 'LIKE', '%'.$keyword.'%');
        }

        $columns = [
            'candidates.id',
            'candidates.name',
            'candidates.candidate_category_id',
            'candidate_categories.name as category_name',
            'candidates.age',
            'candidates.birth_date',
            'candidates.german_level',
            'candidates.gender',
            'candidates.avatar',
            'candidates.created_at',
        ];

        $data = $query->orderBy('candidates.id', 'DESC')->get($columns);

        return response()->json([
            'data' => $data,
            'message' => 'success',
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
