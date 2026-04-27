@extends('layouts.main.master')
@section('title')
Giới thiệu về {{$setting->company}}
@endsection
@section('description')
{{$setting->webname}}
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
               <li class="active">Về Chúng Tôi</li>
           </ul>
       </div>
   </div>
   <!-- breadcrumb end -->
   <div class="about-area py-80">
      <div class="container">
         <div class="row">

            <div class="col-lg-12">
               <div class="about-right wow fadeInUp" data-wow-delay=".25s">
                  <div class="site-heading mb-3 text-center">
                     <span class="site-title-tagline"><i class="far fa-school"></i> Về chúng tôi</span>
                     <h2 class="site-title">{{$setting->company}}</h2>
                  </div>
                  <div class="about-text">{!!$gioithieu->content!!}
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="testimonial-area ts-bg pt-80 pb-60">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="site-heading wow fadeInDown" data-wow-delay=".25s">
                  <span class="site-title-tagline"><i class="fas fa-school"></i> Testimonials</span>
                  <h2 class="site-title text-white">Khách hàng nói gì về <span>VNTALENTHUB</span> </h2>
                  <p class="text-white">
                     Luôn đặt khách hàng làm trọng tâm, VNTALENTHUB mang đến sự khác biệt rõ rệt trong hành trình du học của bạn.
                  </p>
               </div>
            </div>
            <div class="col-lg-8">
               <div class="testimonial-slider owl-carousel owl-theme wow fadeInUp" data-wow-delay=".25s">
                  @foreach ($reviewcus as $item)
                  <div class="testimonial-item">
                     <div class="testimonial-quote">
                        <span class="testimonial-quote-icon"><i class="fal fa-quote-right"></i></span>
                        <div class="testimonial-shadow-icon">
                           <img src="{{url('frontend/img/quote.svg')}}" alt="">
                        </div>
                        <p>
                           {!!languageName($item->content)!!}
                        </p>
                        <div class="testimonial-rate">
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                           <i class="fas fa-star"></i>
                        </div>
                     </div>
                     <div class="testimonial-content">
                        <div class="testimonial-author-img">
                           <img src="{{$item->avatar}}" alt="">
                        </div>
                        <div class="testimonial-author-info">
                           <h4>{{languageName($item->name)}}</h4>
                           <p>{{languageName($item->position)}}</p>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="team-area py-40">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mx-auto">
               <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                  <span class="site-title-tagline"><i class="fas fa-school"></i> Our Team</span>
                  <h2 class="site-title">Đội Ngũ <span>Nhân Sự</span></h2>
                  <div class="heading-divider"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="portfolio-slider owl-carousel">
               @foreach ($founder as $item)
               <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                  <div class="team-img">
                     <img src="{{$item->image}}" alt="thumb">
                     <div class="team-social-wrap">
                        <div class="team-social-btn">
                           <button type="button"><i class="far fa-share-alt"></i></button>
                        </div>
                     </div>
                  </div>
                  <div class="team-content">
                     <h4><a href="javascript:;">{{$item->name}}</a></h4>
                     <span>{{$item->position}}</span>
                  </div>
               </div>
               @endforeach
               
            </div>
         </div>
      </div>
   </div>
   <div class="team-area py-40">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mx-auto">
               <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                  <h2 class="site-title">Giấy phép hoạt động </h2>
                  <div class="heading-divider"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="portfolio-slider owl-carousel">
               @foreach ($giayphep as $item)
               <div class="team-item wow fadeInUp" data-wow-delay=".25s">
                  <div class="team-img">
                     <img src="{{$item->image}}" alt="thumb">
                  </div>
                  <div class="team-content">
                     <h4><a href="javascript:;">{{$item->name}}</a></h4>
                     <span>{{$item->position}}</span>
                  </div>
               </div>
               @endforeach
               
            </div>
         </div>
      </div>
   </div>
   <div class="partner-area bg pt-60 pb-60">
      <div class="container">
         <div class="partner-wrapper partner-slider owl-carousel owl-theme">
            @foreach ($partner as $item)
            <img src="{{$item->image}}" alt="thumb">
            @endforeach
         </div>
      </div>
   </div>
</main>
@endsection