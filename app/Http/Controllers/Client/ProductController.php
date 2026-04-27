<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use App\models\product\Category;
use App\models\blog\Blog;
use App\models\product\TypeProduct;
use App\models\construction\Construction;
use  App\models\product\TypeProductTwo;
use App\models\tag\Tags;
use App\models\tag\TagCate;
use Session;


class ProductController extends Controller
{
    public function tracutruong()
    {
        $data['list'] = Product::with('cate')->where([
            ['status', '=', 1]
        ])
        ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','preserve','ingredient','species','origin')
        ->paginate(12);
        $data['filter'] = TagCate::with(['tags'])->where('status',1)->get();
        $data['title'] = "Tra cứu trường";
        $data['content'] = 'none';
        return view('product.tracuutruong',$data);
    }
    public function bangxephang($slug)
    {
        if($slug == 'thewu'){
            $data['list'] = Product::with('cate')->where([
                ['status', '=', 1],
                ['ingredient', '!=', null],
            ])
            ->orderBy('ingredient','ASC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','preserve','ingredient','species','origin')
            ->paginate(12);
        }
        if($slug == 'qswu'){
            $data['list'] = Product::with('cate')->where([
                ['status', '=', 1],
                ['species', '!=', null],
            ])
            ->orderBy('species','ASC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','preserve','ingredient','species','origin')
            ->paginate(12);
        }
        if($slug == 'arowu'){
            $data['list'] = Product::with('cate')->where([
                ['status', '=', 1],
                ['origin', '!=', null],
            ])
            ->orderBy('origin','ASC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','preserve','ingredient','species','origin')
            ->paginate(12);
        }
        $data['title'] = "Bảng Xếp Hạng";
        $data['content'] = 'none';
        return view('product.list',$data);
    }
    public function allProduct()
    {
        
        $data['list'] = Product::where('status',1)->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','cate_slug','type_slug')
        ->paginate(12);
        $data['title'] = "Tất cả sản phẩm";
        $data['content'] = 'none';
        return view('product.list',$data);
    }
    public function allListCate($danhmuc)
    {
        
        if($danhmuc == "tat-ca"){
            $data['list'] = Product::where('status',1)->orderBy('id','DESC')->select('id','category','name','discount','price','images','slug','description')
            ->paginate(12);
            $data['title'] = "Tất cả sản phẩm";
            $data['content'] = 'none';
        }else{
            $data['list'] = Product::where(['status'=>1,'cate_slug'=>$danhmuc])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description')
            ->paginate(12);
            $data['cateno'] = Category::where('slug',$danhmuc)->first(['id','name','avatar','content']);
            $data['hastagType'] = TypeProduct::where(['status'=>1,'cate_id'=>$data['cateno']->id])->orderBy('id','DESC')
            ->get(['slug','id', 'name','cate_slug']);
            $cate_id = $data['cateno']->id;
            $data['title'] = languageName($data['cateno']->name);
            $data['content'] = $data['cateno']->content;
        }
        return view('product.list',$data);
    }
    public function allListType($danhmuc,$loaidanhmuc){
        $data['list'] = Product::where(['status'=>1,'cate_slug'=>$danhmuc,'type_slug'=>$loaidanhmuc])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description')
            ->paginate(12);
        $data['type'] = TypeProduct::where('slug',$loaidanhmuc)->first(['id','name','cate_id','content']);
        $cate_id = $data['type']->cate_id;
        $data['typeCate'] = TypeProduct::where([
            ['status', '=', 1],
            ['cate_id', '=',$cate_id]
        ])->orderBy('id','DESC')
        ->get(['cate_id','id', 'name','avatar']);
        $data['hastagType'] = TypeProduct::where(['status'=>1,'cate_id'=>$cate_id])->orderBy('id','DESC')
        ->get(['slug','id', 'name','cate_slug']);
        $data['title'] = languageName($data['type']->name);
        $data['content'] = $data['type']->content;
        return view('product.list',$data);
    }
    public function allListTypeTwo($danhmuc,$loaidanhmuc,$thuonghieu){
        $data['list'] = Product::where(['status'=>1,'cate_slug'=>$danhmuc,'type_slug'=>$loaidanhmuc,'type_two_slug'=>$thuonghieu])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images','slug','cate_slug','type_slug','description')
            ->paginate(12);
        $data['type'] = TypeProductTwo::where('slug',$thuonghieu)->first(['id','name','cate_id','content']);
        // $cate_id = $data['type']->cate_id;
        // $data['typeCate'] = TypeProduct::where([
        //     ['status', '=', 1],
        //     ['cate_id', '=',$cate_id]
        // ])->orderBy('id','DESC')
        // ->get(['cate_id','id', 'name','avatar']);
        $data['title'] = languageName($data['type']->name);
        $data['content'] = $data['type']->content;
        return view('product.list',$data);
    }
    public function CateProList($cate)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('category',$cate)
        ->orderBy('id','ASC')
        ->paginate(12);
        $data['cate'] = Category::where('id',$cate)->first();
        return view('product.list',$data);
    }
    public function TypeProList($type)
    {
        $data['list'] = Product::with('customer','cate')
        ->where('type_cate',$type)
        ->orderBy('id','ASC')
        ->paginate(12);
        $cate = TypeProduct::where('id',$type)->first();
        $data['title_page'] = languageName($cate->name);
        return view('product.list',$data);
    }
    public function getproajax(Request $request)
    {
        if($request->cate == "all"){
            $product = Product::where([
                ['status', '=', 1]
            ])->limit(9)->orderBy('id','ASC')->get(['id','name','discount','price','images']);
        }else{
            $product =  Product::where(['status'=>1,'category'=>$request->cate])
            ->orderBy('id','DESC')
            ->select('id','category','name','discount','price','images')
            ->get();
        }
        $view = view("layouts.product.getproajax",compact('product'))->render();
        return response()->json(['html'=>$view]);
    }
    public function filterProduct(Request $request)
    {
        $product = Product::query();
        if($request->cate != null){
            $product = $product->where('cate_slug',$request->cate);
        }
        $rank = "";
        if($request->rank == 'thewu'){
            $product->where([
                ['ingredient', '!=', null],
            ]);
            $rank = 'thewu';
        }
        if($request->rank == 'qswu'){
            $product->where([
                ['species', '!=', null]
            ]);
            $rank = 'qswu';
        }
        if($request->rank == 'arowu'){
            $product->where([
                ['origin', '!=', null]
            ]);
            $rank = 'arowu';
        }
        if( $request->fillter != null ){
            foreach($request->fillter as $key => $item){
                if ($key == 0 ) {
                    $product = $product->whereJsonContains('tags', (int)$item);
                }else{
                    $product = $product->orWhereJsonContains('tags', (int)$item);
                }
                
            }
        }

        if($request->keyword != null){
            $product = $product->where('name', 'LIKE', '%'.$request->keyword.'%');
        }

        

        
        if(isset($request->sortby)){
            if($request->sortby == "price-asc"){
                $product = $product->orderBy('price','ASC');
            }elseif($request->sortby == "price-desc"){
                $product = $product->orderBy('price','DESC');
            }elseif($request->sortby =="created-asc"){
                $product = $product->orderBy('id','DESC');
            }else{
                $product = $product; 
            }
        }

 


        $product = $product->with('cate')->where('status',1)->paginate(12);
        
        $view = view("layouts.product.filter",compact('product','rank'))->render();
        // dd($product->count());
        return response()->json([
            'html'=>$view
        ]);
    }
    public function detail_product($cate,$type,$id)
    {
        $data['product'] = Product::with([
            'typeCate' => function ($query) {
                $query->select('id', 'name','avatar','slug'); 
            },
            'cate' => function ($query) {
                $query->where('status',1)->limit(5)->select('id','name','avatar','slug'); 
            },
        ])->where('slug',$id)->first();
        $data['productlq'] = Product::where('category',$data['product']->category)->get(['id','name','images','discount','price','slug','cate_slug','type_slug','description']);
        return view('product.detail',$data);
    }
    public function compare(Request $request)
    {
//         $request->session()->flush();
// return;
        $id = $request->id;
        $data['product'] = Product::where('id',$id)->first(['id','name','images','category','discount','price','size']);
        $compare = session()->get('compareProduct', []);
        if(isset($compare[$id])) {
            session()->put('compareProduct', $compare);
            return response()->json([
                'message' => 'exist'
            ]);
        }
        else {
            if(empty($compare)){
                $compare[$id] = [
                    "idpro" => $id,
                    "name" => $data['product']->name,
                    "cate" => $data['product']->category,
                    "discount" => $data['product']->discount,
                    "price" => $data['product']->price,
                    "size" => $data['product']->size,
                    "image" => json_decode($data['product']->images)[0]
                ];
            }else{
                foreach($compare as $val){
                    if($data['product']->category != $val['cate']){
                        return response()->json([
                            'data'=> [],
                            'message' => 'error'
                        ]);
                    }
                }
                if(count($compare) == 3){
                    return response()->json([
                        'data'=> [],
                        'message' => 'limit3'
                    ]);
                }
                $compare[$id] = [
                    "idpro" => $id,
                    "name" => $data['product']->name,
                    "cate" => $data['product']->category,
                    "discount" => $data['product']->discount,
                    "price" => $data['product']->price,
                    "size" => $data['product']->size,
                    "image" => json_decode($data['product']->images)[0]
                ];
            }
            session()->put('compareProduct', $compare);
            $compareProduct = session()->get('compareProduct', []);
            
            return response()->json([
                'data'=> $compareProduct,
                'qty'=> count($compareProduct),
                'message' => 'success'
            ]);
            
        }
        
    }
    public function removeCompare(Request $request)
    {
        if($request->id) {
            $compare = session()->get('compareProduct');
            if(isset($compare[$request->id])) {
                unset($compare[$request->id]);
                session()->put('compareProduct', $compare);
            }
            $list = session()->get('compareProduct', []);
            $view = view("layouts.product.compare",compact('list'))->render();
            return response()->json(['html'=>$view]);
        }

        
    }
    public function compareList()
    {
        $data['list'] = session()->get('compareProduct', []);
        return view('compare.product',$data);
    }
    public function search_product(Request $request)
    {
        $language_current = Session::get('locale');
        $keyword = $request->keyword;
         $data['product'] = Product::where(['language'=>$language_current])
         ->where('name', 'LIKE', '%'.$keyword.'%')
         ->paginate(12);
         return view('product.search',$data);
    }
    
}
