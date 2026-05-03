<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\models\HomeChooseItem;
use App\Services\CloudflareImageService;
use Illuminate\Http\Request;

class HomeChooseItemController extends Controller
{
    protected $cloudflareService;

    public function __construct(CloudflareImageService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }

    public function create(Request $request, HomeChooseItem $model)
    {
        $data = $model->saveItem($request);

        return response()->json([
            'message' => 'Save Success',
            'data' => $data,
        ], 200);
    }

    public function list(Request $request)
    {
        $keyword = $request->keyword ?? '';
        $q = HomeChooseItem::query()->orderBy('sort_order', 'asc')->orderBy('id', 'asc');
        if ($keyword !== '') {
            $q->where('title', 'LIKE', '%'.$keyword.'%');
        }
        $data = $q->get(['id', 'title', 'icon', 'sort_order', 'status', 'created_at']);

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }

    public function delete($id)
    {
        $query = HomeChooseItem::find($id);
        if (! $query) {
            return response()->json(['message' => 'Not found'], 404);
        }
        if ($query->icon && strpos((string) $query->icon, 'imagedelivery.net') !== false) {
            $this->cloudflareService->deleteImage($query->icon);
        }
        $query->delete();

        return response()->json(['message' => 'Delete Success'], 200);
    }

    public function edit($id)
    {
        $data = HomeChooseItem::where('id', $id)->first();

        return response()->json([
            'data' => $data,
            'message' => 'success',
        ]);
    }
}
