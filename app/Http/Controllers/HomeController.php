<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\models\product\Category;
use App\models\product\Product;
use App\models\blog\Blog;
use Session;
use App\models\website\Partner;
use App\models\blog\BlogCategory;
use App\models\ReviewCus;
use App\models\PageContent;
use App\models\Project;
use App\models\website\Banner;
use App\models\BannerAds;
use App\models\website\Video;
// use  App\models\website\Founder;
use App\models\website\AlbumAffter;
use App\models\Promotion;

class HomeController extends Controller
{
    public function home()
    {
        $data['hotnews'] = Blog::where([
            ['status','=',1]
        ])->orderBy('id','DESC')->limit(6)->get(['id','title','slug','created_at','image','description']);
        $data['bannerads'] = BannerAds::where(['status'=>1])->get();
        $data['bannermobile'] = Banner::where(['status'=>2])->get(['id','image','link','status']);
        $data['gioithieu'] = PageContent::where(['slug'=>'gioi-thieu','language'=>'vi'])->first(['id','title','content','image']);
        $data['partner'] = Partner::where(['status'=>1])->get();
        $data['logokhachhang'] = AlbumAffter::where(['status'=>1])->get();
        $data['reviewcus'] = ReviewCus::where(['status'=>1])->get();
        $data['hocbong'] = Promotion::where(['status'=>1])->get();
        $data['videos'] = Video::where(['status'=>1])->get(['id','name','image','link']);
        return view('home',$data);
    }
}
