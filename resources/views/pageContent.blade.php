@extends('layouts.main.master')
@section('title')
{{$pagecontentdetail->title}}
@endsection
@section('description')
{{$pagecontentdetail->title}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
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
               <li><a href="{{route('home')}}">Hỗ trợ khách hàng</a></li>
               <li class="active">{{$pagecontentdetail->title}}</li>
           </ul>
       </div>
   </div>
   <div class="service-single py-80">
      <div class="container">
          <div class="service-single-wrap">
              <div class="row">
                 <div class="col-xl-12 col-lg-12">
                    <div class="service-details">
                        <div class="content">
                            <h1 class="mb-20 title-content text-center">{{$pagecontentdetail->title}}</h1>
                            {!!($pagecontentdetail->content)!!}
                        </div>
                    </div>
                </div>
                  
              </div>
          </div>
      </div>
  </div>
</main>

@endsection