<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\CustomerLead;
use Illuminate\Http\Request;

class CustomerLeadController extends Controller
{
    public function list(Request $request)
    {
        $keyword = trim((string) $request->keyword);

        $query = CustomerLead::query()->orderBy('id', 'DESC');

        if ($keyword !== '') {
            $query->where(function ($subQuery) use ($keyword) {
                $subQuery->where('full_name', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('phone', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('email', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('province', 'LIKE', '%' . $keyword . '%');
            });
        }

        $data = $query->get();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function detail($id)
    {
        $data = CustomerLead::find($id);

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function delete($id)
    {
        $lead = CustomerLead::find($id);

        if (!$lead) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        $lead->delete();

        return response()->json([
            'message' => 'Delete Success',
        ], 200);
    }
}
