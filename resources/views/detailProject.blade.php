@extends('layouts.main.master')
@section('title')
{{$detail->name}}
@endsection
@section('description')
{{$detail->description}}
@endsection
@section('image')
@php
   $img = json_decode($detail->images);
@endphp
{{$img[0]}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section id="ft-breadcrumb" class="ft-breadcrumb-section position-relative" data-background="{{url('frontend/img/bread-bg.jpg')}}" style="background-image: url(&quot;{{url('frontend/img/bread-bg.jpg')}}&quot;);">
   <span class="background_overlay"></span>
   <span class="design-shape position-absolute"><img src="{{url('frontend/img/tmd-sh.png')}}" alt=""></span>
   <div class="container">
      <div class="ft-breadcrumb-content headline text-center position-relative">
         <h1>{{$detail->name}}</h1>
         <div class="ft-breadcrumb-list ul-li">
            <ul>
               <li><a href="{{route('home')}}">Home</a></li>
               <li>Dự Án</li>
               <li>{{$detail->name}}</li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section id="ft-project-details" class="ft-project-details-section page-padding">
   <div class="container">
      <div class="ft-project-overview">
         <div class="row">
            <div class="col-lg-12 ft-project-overview-text-wrapper headline pera-content text-center">
               <h3>Hình Ảnh Dự Án </h3>
               <div class=" zoom-gallery">
                  <div class="row">
                     @foreach ($img as $item)
                     <div class="col-lg-4 col-6">
                        <div class="ft-project-details-img" style="margin-bottom:15px;">
                           <a href="{{$item}}">
                              <img style="width: 100%; height: 250px; object-fit: cover;"  width="100%" src="{{$item}}" alt="">
                           </a>
                        </div>
                     </div>
                     @endforeach
                  </div>
               </div>
               
            </div>
         </div>
      </div>
      <div class="ft-project-overview-text-wrapper headline pera-content text-center">
         <h3>Thông Tin Dự Án</h3>
         {!!languageName($detail->content)!!}
      </div>
   </div>
</section>
@endsection