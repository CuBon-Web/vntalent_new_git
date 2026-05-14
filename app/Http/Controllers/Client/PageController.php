<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\product\Product;
use Session;
use App\models\product\Category;
use App\models\product\TypeProduct;
use DB,stdClass,File;
use App\models\District;
use Goutte\Client;
use App\models\blog\Blog;
use App\models\MessContact;
use App\models\Services;
use App\models\ServiceCate;
use App\models\website\Prize;
use App\models\website\Founder;
use App\models\website\Partner;
use App\models\ReviewCus;
use App\models\PageContent;
use App\models\Project;
use App\models\Solution;
use App\models\Promotion;
use App\models\website\AlbumAffter;
use App\models\website\Video;
use App\models\Candidate;
use App\models\CandidateCategory;
class PageController extends Controller
{
    public function aboutNation($slug) {
        $data['detail'] = ServiceCate::where('slug',$slug)->first();
        return view('duhoc.about',$data);
    }
    public function duhoc($slug) {
        $data['detail'] = ServiceCate::where('slug',$slug)->first();
        return view('duhoc.index',$data);
    }
    public function tintucduhoc($slug) {
        $data['cate'] = ServiceCate::where('slug',$slug)->first();
        $data['detail'] = Services::where('cate_slug',$slug)->paginate(9);
        return view('duhoc.blog',$data);
    }
    public function detailtintucduhoc($slug,$title) {
        $data['cate'] = ServiceCate::where('slug',$slug)->first();
        $data['detail'] = Services::where('slug',$title)->first();
        $data['bloglq'] = Services::where('cate_slug',$slug)->get();
        return view('duhoc.blog_detail',$data);
    }
    public function hocbongDetail($slug)
    { 
        $data['detail'] = Promotion::where('slug',$slug)->first();
        $data['lq'] = Promotion::where('status',1)->limit(6)->get();
        return view('hocbong.detail',$data);
    }
    public function hocbong()
    { 
        $data['list'] = Promotion::where('status',1)->paginate(9);
        return view('hocbong.list',$data);
    }
    public function orderNow()
    { 
        return view('orderNow');
    }
    public function baogia()
    {
        return view('baogia');
    }
    public function menu()
    {
        
        $data['allproduct'] = Product::where([
            ['status', '=', 1]
        ])->limit(9)->orderBy('id','DESC')->get(['id','name','discount','price','images','slug']);
        $data['hotnews'] = Blog::where([
            ['status','=',1],
            ['type_news','=','tin-hot']
        ])->orderBy('id','DESC')->limit(7)->get(['id','title','slug','created_at','image']);
        return view('menu',$data);
    }
    public function candidateList(Request $request)
    {
        $data['candidateCategory'] = CandidateCategory::where('status', 1)->orderBy('name', 'ASC')->get(['id', 'name']);

        return view('candidateList', $data);
    }

    /**
     * JSON danh sách ứng viên (lọc + phân trang) cho trang ung-vien.html.
     */
    public function candidateListData(Request $request)
    {
        $paginator = $this->candidateFilteredQuery($request)->paginate(9)->appends($request->query());

        return response()->json([
            'data' => $paginator->items(),
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'last_page' => $paginator->lastPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'from' => $paginator->firstItem(),
                'to' => $paginator->lastItem(),
            ],
            'links' => [
                'prev_url' => $paginator->previousPageUrl(),
                'next_url' => $paginator->nextPageUrl(),
            ],
        ]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function candidateFilteredQuery(Request $request)
    {
        $query = Candidate::leftJoin('candidate_categories', 'candidate_categories.id', '=', 'candidates.candidate_category_id')
            ->where('candidates.status', 1);

        $categories = array_values(array_filter((array) $request->input('category', [])));
        if (count($categories)) {
            $query->whereIn('candidates.candidate_category_id', $categories);
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

        $levels = array_values(array_filter((array) $request->input('german_level', [])));
        if (count($levels)) {
            $query->whereIn('candidates.german_level', $levels);
        }

        if ($request->filled('gender') && in_array((string) $request->gender, ['1', '2'], true)) {
            $query->where('candidates.gender', (int) $request->gender);
        }

        return $query->orderBy('candidates.id', 'DESC')
            ->select([
                'candidates.id',
                'candidates.name',
                'candidates.age',
                'candidates.birth_date',
                'candidates.german_level',
                'candidates.gender',
                'candidates.avatar',
                'candidates.graduation_image',
                'candidates.other_documents',
                'candidates.short_bio',
                'candidates.video_url',
                'candidate_categories.name as category_name',
            ]);
    }
    public function quickview($id){
        $data['product'] = Product::with('cate')->where('id',$id)->first();
        return view('layouts.product.quickview',$data);
    }
    public function videoHocVien(){
        $data['video'] = Video::where(['status'=>1])->paginate(9);
        return view('videoHocVien',$data);
    }
    public function feedbackHocVien(){
        $data['feedback'] = ReviewCus::where(['status'=>1])->paginate(9);
        return view('feedbackHocVien',$data);
    }
    public function aboutUs(){
        $data['partner'] = Partner::where(['status'=>1])->get();
        $data['reviewcus'] = ReviewCus::where(['status'=>1])->get();
        $data['founder'] = Founder::where(['status'=>1])->get();
        $data['gioithieu'] = PageContent::where(['slug'=>'gioi-thieu','language'=>'vi'])->first(['id','title','content','image']);
        $data['giayphep'] = AlbumAffter::where(['status'=>1])->get();
        return view('aboutus',$data);
    }
    public function contact()
    {
        return view('contactus');
    }
    public function getPostInfor()
    {
        $data['category_product'] = Category::where('status',1)->get();
        return view('post_info.index',$data);
    }
    public function postPostInfor(Request $request,Product $product )
    {
        $data = $product->createClient($request);
        $data['category'] = Category::where(['status'=> 1])->orderBy('id','ASC')->get();
        $data['categoryFirst'] = Category::where(['status'=> 1])->orderBy('id','ASC')->first();
        $productNewFirstTab = Product::where([
            'category'=> $data['categoryFirst'] ? $data['categoryFirst']->id : 0,
            'status' => 0
        ])->with('customer')
        ->orderBy('id','ASC')
        ->limit(10)->get()->toArray();
        $data['productNewFirstTab'] = array_chunk($productNewFirstTab,2);
        return view('home',$data)->with('success','Tin của bạn đang được xét duyệt!');
    }
    public function typeproduct($id)
    {
        $arr = [];
        $data = TypeProduct::where('cate_id',$id)->get();
        $lang = Session::get('locale');
        foreach($data as $item){
            $obj = new stdClass();
            $obj->name = languageName($item->name);
            $obj->id = $item->id;
            $arr[] = $obj;
        }
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $arr
    	],200);
    }
    public function district($id)
    {
        $data = District::where('_province_id',$id)->get();
        return response()->json([
    		'message' => 'get data Success',
    		'data'=> $data
    	],200);
    }
    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $code = Session::get('locale');
        $arr = [];
        $arrb = [];
        $arrOpt = [];
        //search option
        $productOpt =  Product::with('cate')
        ->where('status',1)
        ->get()
        ->toArray();
        foreach($productOpt as $key => $item){
            $fielName = json_decode($item['name']);
            foreach($fielName as $i){
                if(strpos(strtolower(stripVN($i->content)), strtolower(stripVN($keyword))) !== false && $i->lang_code == $code){
                    array_push($arr,$productOpt[$key]);
                }
            }
        }
        $data['keyword'] = $request->keyword;
        $data['countproduct'] = count($arr);
        $data['resultPro'] = $arr;
        return view('search_result',$data);
    }
    public function postcontact(Request $request){
        $data = new MessContact();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->mess = $request->mess;
        $data->save();
        if($data){
            return \Redirect::to('/')->with('success', 'Gửi tin thành công');
        }else{
            return back()->with('error', 'Gửi tin thất bại');
        }
        
    }
    public function serviceCateList($slug)
    {
        $data['detail_service'] = Solution::where(['slug'=>$slug])->first();
        return view('servicelist',$data);
    }
    public function serviceDetail($slug)
    {
        $data['detail_service'] = Services::where(['slug'=>$slug])->first();
        
        return view('servicedetail',$data);
    }
    public function serviceList()
    {
        $data['list'] = Services::where('status',1)->paginate(9);
        
        return view('servicelist',$data);
    }
    public function duanTieuBieu()
    {
        $data['duan'] = Project::where('status',1)->paginate(12);
        $data['album'] = Prize::where(['status'=>1])->get(['id','image','name','link']);
        return view('album',$data);
    }
    public function duanTieuBieuDetail($slug)
    {
        $data['detail'] = Project::where('slug',$slug)->first();
        return view('detailProject',$data);
    }
    public function fag()
    {
        return view('faq');
    }
}
