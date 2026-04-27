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
            <li class="active">{{($detail->title)}} </li>
         </ul>
      </div>
   </div>
   <div class="blog-single py-80">
      <div class="container">
         <div class="row g-4">
            <div class="col-lg-12">
               <div class="blog-single-wrap">
                  <div class="blog-single-content">
                     <div class="blog-info">
                        <div class="blog-details service-details">
                           <h1 class="blog-details-title mb-20 title-content">{{($detail->name)}}</h1>
                           <div class="content">
                              {!!($detail->link)!!}
                           </div>
                        </div>
                        <div class="blog-area pt-60">
                           <div class="container">
                              <div class="row">
                                 <div class="col-lg-6 mx-auto">
                                    <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                                       <h2 class="site-title">Học bổng khác</h2>
                                       <div class="heading-divider"></div>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="blog-lq-slider owl-carousel">
                                    @foreach ($lq as $item)
                                    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                       <div class="blog-item-img">
                                          <a href="{{route('hocbongDetail',['slug'=>$item->slug])}}">
                                             <img src="{{$item->image}}" alt="Thumb">
                                          </a>
                                       </div>
                                       <div class="blog-item-info">
                                          <h4 class="blog-title">
                                             <a href="{{route('hocbongDetail',['slug'=>$item->slug])}}">{{($item->name)}}</a>
                                          </h4>
                                          <p class="line_2">
                                             {{($item->description)}}
                                          </p>
                                          <a class="theme-btn" href="{{route('hocbongDetail',['slug'=>$item->slug])}}">Đọc tiếp<i class="fas fa-arrow-right"></i></a>
                                       </div>
                                    </div>
                                    @endforeach
                                    
                                 </div>
                     
                     
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
@endsection