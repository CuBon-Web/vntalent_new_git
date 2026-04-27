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
<script>
      $(".discover-filter-activation").on("click", function () {
        $(this).toggleClass("open");
        $(".default-exp-expand").slideToggle("400");
      });
</script>
@endsection
@section('css')
<style>
   .service-sidebar {
    position: sticky;
    top: 80px;
}

.filter-container__selected-filter {
    background: var(--mainColor);
    filter: hue-rotate(17deg) contrast(1.2)
}

.filter-container__selected-filter:before {
    content: '';
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: rgba(255,255,255,0.6);
    z-index: 0
}

.filter-item--check-box label {
    cursor: pointer;
    will-change: transform
}

.filter-item--check-box label:hover {
    color: var(--mainColor)
}

.filter-item--check-box .fa {
    width: 20px;
    min-width: 20px
}

.filter-item--check-box input+.fa:before {
    content: "";
    border-radius: 10px;
    font-size: 18px;
    border: solid 1px var(--accentColor1);
    line-height: 40px;
    position: absolute;
    top: -16px;
    height: 20px !important;
    width: 20px
}

.filter-item--check-box input:checked+.fa:before {
    border-color: var(--mainColor);
    background: var(--mainColor)
}



.filter-item--check-box input:hover+.fa:after {
    filter: brightness(0.5);
    opacity: 1
}

.filter-item--check-box input:checked+.fa:after {
    opacity: 1
}

.filter-item--check-box input:checked:hover+.fa:after {
    filter: brightness(1)
}

.filter-item--check-box .fa2 {
   background: #fbfbfb;
    width: 100%;
    border-color: #0097b2 !important;
    color: #003f72;
    font-weight: 500;
}

.filter-item--check-box input:checked+.fa2 {
    background: #0097b2;
    color: white;
}

.filter-item--check-box input:hover+.fa2 {
    border-color: var(--mainColor) !important;
    color: var(--mainColor)
}

.filter-group ul {
    overflow-y: auto;
    margin: 15px 0;
    will-change: transform
}
.filter-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px
}
@media (max-width: 992px) {
   .filter-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 10px
}
}
@media (min-width: 992px) {
    .filter-group ul {
        max-height:155px
    }

    .filter-group ul::-webkit-scrollbar-track {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        background-color: #F5F5F5;
        border-radius: 6px
    }

    .filter-group ul::-webkit-scrollbar {
        width: 2px;
        background-color: #F5F5F5
    }

    .filter-group ul::-webkit-scrollbar-thumb {
        border-radius: 6px;
        background-image: -webkit-gradient(linear, left bottom, left top, color-stop(0.44, var(--mainColor)), color-stop(0.72, var(--mainColor)), color-stop(0.86, var(--mainColor)))
    }
    
}



.btn_drop_filter {
    display: none;
}
.default-exp-expand {
    display: none;
}
</style>
@endsection
@section('content')
<!-- breadcrumb -->
<div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
   <div class="container">
       <h2 class="breadcrumb-title">Tra cứu trường</h2>
       <ul class="breadcrumb-menu">
           <li><a href="{{route('home')}}">Trang chủ</a></li>
           <li class="active">Tra cứu trường</li>
       </ul>
   </div>
</div>
<!-- breadcrumb end -->
<div class="feature-area fta-2 pt-40">
   <div class="container">
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
                 <div class="col-md-6 col-lg-4">
                  <a href="javascript:;" class="theme-btn discover-filter-activation"> <i class="fas fa-filter-list"></i> Thêm giá trị lọc</a>
                 </div>
                 <div class="col-md-12 col-lg-12 default-exp-expand pt-10">
                  @foreach ($filter as $item)
                  <!-- sidebar widget end -->
                  <div class="sidebar-widget">
                      <p><strong>{{$item->name}}:</strong></p>
                      <div class="aside-content filter-group">
                       <ul class="filter-vendor filter-grid list-unstyled m-0">
                        @foreach ($item->tags as $tag)
                        <li class="filter-item filter-item--check-box  ">
                            <label class="d-flex align-items-baseline m-0 {{$tag->slug}}" >
                            <input type="checkbox" id="filter-{{$tag->slug}}" class="d-none" name="fillter" onclick="toggleFilter(this)"  value="{{$tag->id}}">
                            <span class="fa2 px-2 py-1 rounded border">{{$tag->name}}</span>
                            </label>
                         </li>
                        @endforeach
                       </ul>
                    </div>
                  </div>
                  @endforeach
                   
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
               <input type="hidden" name="rank" id="rank" value="" />
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

