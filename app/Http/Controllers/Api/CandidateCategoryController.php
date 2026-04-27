<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\CandidateCategory;

class CandidateCategoryController extends Controller
{
    public function create(Request $request, CandidateCategory $category)
    {
        $data = $category->saveCategory($request);
        return response()->json([
            'message' => 'Save Success',
            'data' => $data
        ], 200);
    }

    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == "") {
            $data = CandidateCategory::orderBy('id', 'DESC')->get();
        } else {
            $data = CandidateCategory::where('name', 'LIKE', '%' . $keyword . '%')
                ->orderBy('id', 'DESC')
                ->get();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }

    public function edit($id)
    {
        $data = CandidateCategory::where(['id' => $id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }

    public function delete($id)
    {
        $query = CandidateCategory::find($id);
        if ($query) {
            $query->delete();
        }
        return response()->json(['message' => 'Delete Success']);
    }
}
