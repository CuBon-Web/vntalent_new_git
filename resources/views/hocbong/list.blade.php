@extends('layouts.main.master')
@section('title')
Danh sách học bổng tại {{$setting->company}}
@endsection
@section('description')
Tin tức nổi bật và mới nhất
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
@endsection
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Học bổng </li>
           </ul>
       </div>
   </div>
   <div class="blog-area py-80">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 mx-auto">
                  <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                      <h2 class="site-title">Danh sách học bổng</h2>
                      <div class="heading-divider"></div>
                  </div>
              </div>
          </div>
          @if (count($list) > 0)

             
          <div class="row g-4">
            @foreach ($list as $item)
              <div class="col-md-6 col-lg-4">
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
              </div>
              @endforeach
          </div>
          <!-- pagination -->
          <div class="pagination-area">
              {{$list->links()}}
          </div>
          @else 
          <h3>Nội dung đang cập nhật...</h3>
          @endif
          <!-- pagination end -->
      </div>
  </div>
</main>
@endsection