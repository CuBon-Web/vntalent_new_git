@extends('layouts.main.master')
@section('title')
{{($detail->name)}}
@endsection
@section('description')
{{($detail->description)}}
@endsection
@section('image')
{{url(''.$detail->image)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<main class="main">
   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
      <div class="container">
         <ul class="breadcrumb-menu">
            <li><a href="{{route('home')}}">Trang chủ</a></li>
            <li class="active">{{($detail->name)}} </li>
         </ul>
      </div>
   </div>
   <div class="blog-single py-80">
      <div class="container">
         <div class="row g-4">
            <div class="col-lg-8">
               <div class="blog-single-wrap">
                  <div class="blog-single-content">
                     <div class="blog-info">
                        <div class="blog-meta">
                           <div class="blog-meta-left">
                              <ul>
                                 <li><i class="far fa-user"></i><a href="#">Admin</a></li>
                                 <li><i class="far fa-calendar"></i>{{date_format($detail->created_at,'d/m/Y')}}</li>
                              </ul>
                           </div>
                        </div>
                        <div class="blog-details service-details">
                           <h1 class="blog-details-title mb-20 title-content">{{($detail->name)}}</h1>
                           <div class="content">
                              {!!languageName($detail->content)!!}
                           </div>
                        </div>
                        <div class="blog-area pt-60">
                           <div class="container">
                              <div class="row">
                                 <div class="col-lg-6 mx-auto">
                                    <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                                       <h2 class="site-title">Bài viết liên quan</h2>
                                       <div class="heading-divider"></div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <aside class="blog-sidebar">
                  <div class="widget recent-post">
                     <h5 class="widget-title">Bài viết khác</h5>
                     @foreach ($bloglq as $item)
                     <div class="recent-post-item">
                        <div class="recent-post-img">
                           <a href="{{route('detailtintucduhoc',['slug'=>$cate->slug,'title'=>$item->slug])}}">
                              <img src="{{$item->image}}" alt="thumb">
                           </a>
                           
                        </div>
                        <div class="recent-post-info">
                           <h6><a href="{{route('detailtintucduhoc',['slug'=>$cate->slug,'title'=>$item->slug])}}">{{($item->name)}}</a></h6>
                           <span><i class="far fa-clock"></i>{{date_format($item->created_at,'d/m/Y')}}</span>
                        </div>
                     </div>
                     @endforeach
                  </div>
                  <!-- category -->
                  <div class="widget category">
                     <h5 class="widget-title">Dịch vụ của chúng tôi</h5>
                     <div class="category-list">
                        @foreach ($servicehome as $item)
                        <a href="{{route('serviceCateList',['slug'=>$item->slug])}}"><i class="far fa-arrow-right"></i>{{$item->name}}</a>
                        @endforeach
                     </div>
                  </div>
               </aside>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection