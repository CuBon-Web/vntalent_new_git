<?php

namespace App\Http\Controllers\Api\Blog;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\blog\BlogCategory;
use App\Services\CloudflareImageService;

class BlogCategoryController extends Controller
{
    protected $apiToken;
    protected $accountId;
    protected $cloudflareService;

    public function __construct(CloudflareImageService $cloudflareService)
    {
        $this->cloudflareService = $cloudflareService;
    }
    public function add(Request $request, BlogCategory $category)
    {
        $data = $category->saveCate($request);
        return response()->json([
    		'message' => 'Save Success',
    		'data'=> $data
    	],200);
    }
    public function list(Request $request)
    {
        $keyword = $request->keyword;
        if($keyword == ""){
            $data = BlogCategory::orderBy('id','DESC')->get();
        }else{
            $data = BlogCategory::where('name', 'LIKE', '%'.$keyword.'%')->orderBy('id','DESC')->get()->toArray();
        }
        return response()->json([
            'data' => $data,
            'message' => 'success'
        ]);
    }
    public function edit($id)
    {
        $data = BlogCategory::where(['id'=>$id])->first();
        return response()->json([
            'message' => 'success',
            'data' => $data
        ], 200);
    }
    public function deleteCateBlog($id)
    {
        $query = BlogCategory::find($id);
        if($query->avatar != null){
            $urlimg =  $query->image;
            $this->cloudflareService->deleteImage($urlimg);
        }
        $query->delete();
        return response()->json(['message'=>'Delete Success'],200);
    }
}
