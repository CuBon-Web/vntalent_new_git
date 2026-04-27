@extends('layouts.main.master')
@section('title')
{{$title}}
@endsection
@section('description')
Danh sách {{$title}}
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('js')
<script src="/frontend/js/filter.js"></script>
@endsection
@section('css')
<style>
   .service-sidebar {
    position: sticky;
    top: 80px;
}
</style>
@endsection
@section('content')
<!-- breadcrumb -->
<div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
   <div class="container">
       <h2 class="breadcrumb-title">Bảng xếp hạng</h2>
       <ul class="breadcrumb-menu">
           <li><a href="{{route('home')}}">Trang chủ</a></li>
           <li class="active">Bảng xếp hạng</li>
       </ul>
   </div>
</div>
<!-- breadcrumb end -->
<div class="feature-area fta-2 pt-80">
   <div class="container">
      <div class="row">
         <div class="col-lg-6 mx-auto">
             <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s" style="visibility: visible; animation-delay: 0.25s; animation-name: fadeInDown;">
                
                 <h2 class="site-title">Các bảng xếp hạng</h2>
                 <div class="heading-divider"></div>
             </div>
         </div>
     </div>
       <div class="feature-wrap">
           <div class="col-lg-12">
               <div class="row g-4">
                  <div class="col-md-6 col-lg-4 col-12">
                     <a href="{{route('bangxephang',['slug'=>'thewu'])}}" class="w-100 ">
                        <div class="process-item {{ request()->slug == 'thewu' ? 'active' : '' }} " style="border: 1px solid #003f72;box-shadow: none;">
                           <div class="content text-center">
                               <h4>Times Higher Education World University</h4>
                           </div>
                       </div>
                     </a>
                     
                   </div>
                   <div class="col-md-6 col-lg-4 col-12">
                     <a href="{{route('bangxephang',['slug'=>'qswu'])}}" class="w-100">
                        <div class="process-item {{ request()->slug == 'qswu' ? 'active' : '' }}" style="border: 1px solid #003f72;box-shadow: none;">
                           <div class="content text-center">
                               <h4>QS World University</h4>
                           </div>
                       </div>
                     </a>
                     
                   </div>
                   <div class="col-md-6 col-lg-4 col-12">
                     <a href="{{route('bangxephang',['slug'=>'arowu'])}}" class="w-100">
                        <div class="process-item {{ request()->slug == 'arowu' ? 'active' : '' }}" style="border: 1px solid #003f72;box-shadow: none;">
                           <div class="content text-center">
                               <h4>Academic Ranking Of World Universities</h4>
                           </div>
                       </div>
                     </a>
                     
                   </div>
               </div>
           </div>
       </div>
       <div class="feature-wrap mt-4">
         <div class="col-lg-12">
             <div class="row">
                <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                     <div class="form-icon">
                         <i class="far fa-input-text"></i>
                         <input type="text" class="form-control" placeholder="Tìm theo trường" id="keyword" onchange="action()">
                     </div>
                 </div>
                   
                 </div>
                 <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                     <div class="form-icon">
                        <i class="far fa-location-pin"></i>
                        <select class="select" name="service" id="cate_slug" onchange="action()">
                           <option value="">Lọc theo quốc gia</option>
                           @foreach ($categoryhome as $item)
                           <option value="{{$item->slug}}">{{languageName($item->name)}}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                   
                 </div>
                 <div class="col-md-6 col-lg-4">
                  <div class="form-group">
                     <div class="form-icon">
                        <i class="far fa-bars-sort"></i>
                        <select class="select" name="service" id="sortBy" onchange="action()">
                           <option selected="" value="default">Mặc định</option>
                           <option value="price-asc">Giá tăng dần</option>
                           <option value="price-desc">Giá giảm dần</option>
                           <option value="created-asc">Mới nhất</option>
                        </select>
                     </div>
                  </div>
                   
                 </div>
                 
             </div>
         </div>
     </div>
   </div>
</div>

<div class="service-single py-40">
   <div class="container">
       <div class="service-single-wrap">
           <div class="row">
              <div class="col-xl-8 col-lg-8">
               <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
               <input type="hidden" name="rank" id="rank" value="{{request()->slug}}" />
               <div class="row product-list-filter">
                  
                  @foreach ($list as $item)
                  @php
                      $bachoc = json_decode($item->preserve);
                      $img = json_decode($item->images);
                  @endphp
                  <div class="col-lg-12 col-xl-12 col-md-12 col-12">
                        
                       <div class="process-item mb-4">
                        <div class="icon">
                           <a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}" class="w-100 h-100">
                              <img src="{{$img[0]}}" alt="">
                           </a>
                           
                       </div>
                       @if (request()->slug == 'thewu')
                       <span class="count">{{$item->ingredient}}</span>
                       @endif
                       @if (request()->slug == 'qswu')
                       <span class="count">{{$item->species}}</span>
                       @endif
                       @if (request()->slug == 'arowu')
                       <span class="count">{{$item->origin}}</span>
                       @endif
                        <div class="content">
                           <a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}">
                              <h4>{{$item->name}}</h4>
                           </a>
                            <div class="blog-item-meta">
                              <ul style="border-bottom: none;">
                                  <li><a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}"><img width="30" src="{{$item->cate->avatar}}" alt=""> {{languageName($item->cate->name)}}</a></li>
                                  <li><a class="bachoc" href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}">Bậc Học: 
                                    @foreach ($bachoc as $item)
                                    @if ($item == 'thpt')
                                    <b>THPT</b>
                                    @elseif($item == 'cao-dang')
                                    <b>Cao Đẳng</b>
                                    @elseif($item == 'du-bi-dai-hoc')
                                    <b>Dự bị đại học</b>
                                    @elseif($item == 'dai-hoc')
                                    <b>Đại Học</b>
                                    @elseif($item == 'sau-dai-hoc')
                                    <b>Sau đại học</b>
                                    @elseif($item == 'hoc-tieng')
                                    <b>Học Tiếng</b>
                                    @else 
                                    <b>Học Nghề</b>
                                    @endif
                                    @endforeach 
                                   </a></li>
                                  <li><a href=""><i class="far fa-eye"></i> 1.2k Comments</a></li>
                              </ul>
                          </div>
                        </div>
                    </div>
                     
                  </div>
                  @endforeach
                  <div class="col-lg-12 col-xl-12 col-md-12 col-12">
                     <div id="pagination_main" style="text-align: center;">
                        {{$list->links()}}
                     </div>
                  </div>
               </div>
             </div>
               <div class="col-xl-4 col-lg-4">
                   <div class="service-sidebar">
                       @include('layouts.main.sidebar')
                   </div>
               </div>
               
           </div>
       </div>
   </div>
</div>
@endsection

