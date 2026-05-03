<?php

namespace App\Http\Controllers\Api\Customer;

use App\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if ($keyword == '') {
            $data = Customer::orderBy('id', 'DESC')->get();
        } else {
            $data = Customer::where('name', 'LIKE', '%'.$keyword.'%')
                ->orWhere('email', 'LIKE', '%'.$keyword.'%')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:customer,email',
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string',
            'note' => 'nullable|string',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new Customer();
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address ?? '';
        $data->note = $request->note ?? '';
        $data->password = bcrypt($request->password);
        $data->status = 0;
        $data->save();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function getEdit($id)
    {
        $data = Customer::find($id);

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function activeCustomer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = null;
        if ($request->filled('id')) {
            $data = Customer::find($request->id);
        }
        if (! $data && $request->filled('email')) {
            $data = Customer::where('email', $request->email)->first();
        }
        if (! $data) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        $data->status = 0;
        $data->password = bcrypt($request->password);
        $data->save();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function changeStatus(Request $request)
    {
        $data = Customer::where('id', $request->id)->first();
        if (! $data && $request->filled('email')) {
            $data = Customer::where('email', $request->email)->first();
        }
        if (! $data) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }
        $data->status = 1;
        $data->save();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function delete($id)
    {
        $data = Customer::find($id);
        if (! $data) {
            return response()->json(['message' => 'Not found'], 404);
        }
        $data->delete();

        return response()->json(['message' => 'success'], 200);
    }

    public function postEdit(Request $request)
    {
        $data = Customer::where('id', $request->id)->first();
        if (! $data) {
            return response()->json(['message' => 'Không tìm thấy khách hàng'], 404);
        }

        $rules = [
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191|unique:customer,email,'.$data->id,
            'phone' => 'required|string|max:50',
            'address' => 'nullable|string',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->email = $request->email;
        $data->address = $request->address ?? '';
        if ($request->filled('password')) {
            $data->password = bcrypt($request->password);
        }
        $data->save();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }
}
