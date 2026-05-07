@extends('layouts.main.master')
@section('title')
{{$setting->company}}
@endsection
@section('description')
{{$setting->webname}}
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<style>
   .blog-item-img .imghome {
   height: 350px;
   }
   .blog-item-img.imgrighthome img {
   max-width: 200px;
   height: 100px;
   }
   .blog-item-info.imgrighthome2 {
   margin-left: 19px;
   }
   .blog-item-info.imgrighthome2 h4 {
   font-size: 16px;
   line-height: normal;
   margin-bottom: 10px;
   }
   .video-review-section {
   position: relative;
   background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
   }
   .video-review-section .site-heading p {
   color: #5f6b7a;
   margin-top: 10px;
   }
   .video-review-card {
   position: relative;
   border-radius: 16px;
   overflow: hidden;
   box-shadow: 0 10px 35px rgba(19, 33, 68, 0.12);
   transition: transform .35s ease, box-shadow .35s ease;
   }
   .video-review-thumb {
   position: relative;
   display: block;
   }
   .video-review-thumb::after {
   content: "";
   position: absolute;
   inset: 0;
   background: linear-gradient(180deg, rgba(16, 18, 24, 0.05) 10%, rgba(16, 18, 24, 0.45) 100%);
   }
   .video-review-thumb img {
   width: 100%;
   height: 260px;
   object-fit: cover;
   }
   .video-review-play {
   position: absolute;
   left: 50%;
   top: 50%;
   transform: translate(-50%, -50%);
   width: 62px;
   height: 62px;
   border-radius: 50%;
   background: rgba(215, 0, 24, 0.9);
   color: #fff;
   display: inline-flex;
   align-items: center;
   justify-content: center;
   font-size: 24px;
   z-index: 2;
   box-shadow: 0 8px 22px rgba(215, 0, 24, 0.4);
   transition: transform .25s ease, background .25s ease;
   }
   .video-review-title {
   margin-top: 12px;
   font-size: 18px;
   font-weight: 600;
   line-height: 1.4;
   color: #152036;
   min-height: 50px;
   }
   .video-review-item:hover .video-review-card {
   transform: translateY(-6px);
   box-shadow: 0 18px 45px rgba(19, 33, 68, 0.2);
   }
   .video-review-item:hover .video-review-play {
   transform: translate(-50%, -50%) scale(1.08);
   background: #b30015;
   }
   .review-video-slider .owl-nav button i {
   background: #fff;
   border: 1px solid #dfe6f4;
   width: 44px;
   height: 44px;
   line-height: 44px;
   border-radius: 50%;
   font-size: 17px;
   color: #1e2b48;
   transition: all .25s ease;
   }
   .review-video-slider .owl-nav button:hover i {
   background: #d70018;
   border-color: #d70018;
   color: #fff;
   }
   .review-video-slider .owl-dots .owl-dot span {
   width: 10px;
   height: 10px;
   background: #d1d8e6;
   border-radius: 50px;
   transition: all .25s ease;
   }
   .review-video-slider .owl-dots .owl-dot.active span {
   width: 26px;
   background: #d70018;
   }
   .video-review-empty {
   text-align: center;
   color: #5f6b7a;
   font-size: 16px;
   padding: 12px 0 4px;
   }
   @media (max-width: 991px) {
   .blog-item-img .imghome {
   height: 250px;
   }
   .blog-item-img.imgrighthome img {
   width: 250px;
   height: 100px;
   }
   .video-review-thumb img {
   height: 200px;
   }
   .video-review-title {
   font-size: 16px;
   min-height: auto;
   }
   }
</style>
@endsection
@section('js')
@endsection
@push('schema')
@php
   $homeSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'WebPage',
      'name' => $setting->company,
      'description' => $setting->webname,
      'url' => url()->current(),
      'primaryImageOfPage' => !empty($banner[0]->image) ? url('' . $banner[0]->image) : null,
   ];
   $serviceItems = [];
   foreach ($servicehome as $idx => $item) {
      $serviceItems[] = [
         '@type' => 'ListItem',
         'position' => $idx + 1,
         'name' => (string) $item->name,
         'url' => route('serviceCateList', ['slug' => $item->slug]),
      ];
   }
   $serviceListSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Danh sách dịch vụ',
      'itemListElement' => $serviceItems,
   ];
@endphp
<script type="application/ld+json">{!! json_encode($homeSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@if(count($serviceItems) > 0)
<script type="application/ld+json">{!! json_encode($serviceListSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
@endpush
@section('content')
<main class="main">
   <!-- hero area -->
  <div class="hero-section d-none d-lg-block">
      <div class="hero-slider owl-carousel">
         @foreach ($banner as $item)
            @if ($item->status == 1)
                <img src="{{$item->image}}" alt="Banner {{$setting->company}}" loading="eager" fetchpriority="high">
            @endif
         @endforeach
      </div>
   </div>
   <div class="d-lg-none">
      <div class="hero-slider-mobile owl-carousel">
         @foreach ($banner as $item)
         @if ($item->status == 2)
             <img src="{{$item->image}}" alt="Banner mobile {{$setting->company}}" loading="lazy">
         @endif
      @endforeach
      </div>
   </div>
   <!-- hero area end -->
   <div class="skill-area py-40">
      <div class="container">
          <div class="skill-wrap">
              <div class="row g-4 align-items-center">
               <div class="col-lg-6">
                  <div class="skill-content wow fadeInUp" data-wow-delay=".25s">
                      <span class="site-title-tagline"><i class="far fa-school"></i>Về chúng tôi</span>
                      <h2 class="site-title">{{$setting->company}}</h2>
                      <div class="skill-text line_6">{!!$gioithieu->content!!}</div>
                      <div class="d-flex justify-content-end gap-2">
                      <a href="#contactus" class="theme-btn mt-5">Liên Hệ<i class="fas fa-arrow-right"></i></a>
                      <a href="{{route('aboutUs')}}" class="theme-btn2 mt-5 btn-outline-white">Xem thêm<i class="fas fa-arrow-right"></i></a>
                      </div>
                  </div>
              </div>
                  <div class="col-lg-6">
                     @php
                        $imggt = json_decode($gioithieu->image);
                        @endphp
                      <div class="skill-img wow fadeInLeft" data-wow-delay=".25s">
                          <img src="{{$imggt[0]}}" alt="Giới thiệu {{$setting->company}}" loading="lazy">
                      </div>
                  </div>
                 
              </div>
          </div>
      </div>
  </div>
   <!-- service area -->
   <div class="service-area sa-2 sa-bg pt-80 pb-80">
      <div class="container">
         <div class="row g-4 align-items-center wow fadeInDown" data-wow-delay=".25s">
            <div class="col-lg-6">
               <div class="site-heading mb-0">
                  <span class="site-title-tagline"><i class="far fa-school"></i> Services</span>
                  <h2 class="site-title text-white">Cách chương trình tuyển sinh</h2>
               </div>
            </div>
            <div class="col-lg-4">
               <p class="text-white">
                  Chương trình tuyển sinh của chúng tôi được thiết kế để phù hợp với nhu cầu và năng lực của từng học viên, đảm bảo quý khách có thể đạt được các mới trong quá trình học tập và phát triển.
               </p>
            </div>
            <div class="col-lg-2">
               <a href="" class="theme-btn">Tất Cả<i class="fas fa-arrow-right"></i></a>
            </div>
         </div>
         <div class="service-slider mt-4 owl-carousel">
            @foreach ($servicehome as $key => $item)
            @php
                $image = json_decode($item->images);
            @endphp
            <div class="service-item">
               <span class="count">0{{$key+1}}</span>
               <div class="service-img">
                  <a href="{{route('serviceCateList',['slug'=>$item->slug])}}">
                  <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$image[0]}}" alt="image">
                  </a>
               </div>
               <div class="service-content">
                  <div class="service-icon">
                     <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{url('frontend/img/package.svg')}}" alt="image">
                  </div>
                  <div class="service-info">
                     <h4 class="service-title">
                        <a href="{{route('serviceCateList',['slug'=>$item->slug])}}">{{$item->name}}</a>
                     </h4>
                     <p class="service-text line_3">
                        {{languageName($item->description)}}
                     </p>
                     <a href="{{route('serviceCateList',['slug'=>$item->slug])}}" class="theme-btn">Chi tiết<i
                        class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
            </div>
            @endforeach
         </div>
      </div>
   </div>
   <!-- service area end -->
   <!-- team-area -->
   
  @if (count($videos) > 0)
  <div class="team-area py-40 video-review-section">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mx-auto">
               <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                  <h2 class="site-title">Video<span> Đánh Giá Học Viên</span></h2>
                  <p>Nhấn vào từng video để nghe chia sẻ thực tế từ học viên đã đồng hành cùng VNTALENTHUB.</p>
                  <div class="heading-divider"></div>
               </div>
            </div>
         </div>
         @if (count($videos) > 0)
         <div class="review-video-slider owl-carousel">
            @foreach ($videos as $item)
            @php
               $videoLink = trim((string) $item->link);
               if (preg_match('/(?:youtu\.be\/|youtube\.com\/watch\?v=|youtube\.com\/shorts\/)([A-Za-z0-9_-]{11})/', $videoLink, $matches)) {
                  $youtubeId = $matches[1];
               } else {
                  $youtubeId = null;
               }
               $thumbUrl = !empty($item->image)
                  ? $item->image
                  : ($youtubeId ? 'https://img.youtube.com/vi/' . $youtubeId . '/hqdefault.jpg' : '');
            @endphp
            @if (!empty($videoLink) && !empty($thumbUrl))
            <div class="video-review-item px-2">
               <div class="video-review-card wow fadeInUp" data-wow-delay=".25s">
                  <a class="video-review-thumb popup-youtube" href="{{ $videoLink }}">
                     <img src="{{ $thumbUrl }}" alt="{{ $item->name }}" loading="lazy">
                     <span class="video-review-play"><i class="fas fa-play"></i></span>
                  </a>
               </div>
               <h4 class="video-review-title">{{ $item->name }}</h4>
            </div>
            @endif
            @endforeach
         </div>
         @else
         <p class="video-review-empty">Hiện chưa có video đánh giá để hiển thị.</p>
         @endif
      </div>
   </div>
   <!-- team-area end -->
   <!-- counter area -->
   
  @endif
   <!-- choose area -->
   <div class="choose-area pt-40 pb-80">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="choose-content wow fadeInUp" data-wow-delay=".25s">
                  <div class="site-heading mb-0">
                     <span class="site-title-tagline"><i class="fas fa-school"></i> Why Choose Us</span>
                     <h2 class="site-title">Tại sao nên chọn <span>VNTALENTHUB</span></h2>
                     <p>
                        VNTALENTHUB mang lại giải pháp du học nghề và lao động quốc tế uy tín và chuyên nghiệp nhất cho khách hàng. Chúng tôi sẽ đồng hành cùng các bạn trên chặng đường phía trước với giấc mơ xuất ngoại trong tầm tay, mọi thủ tục và chi phí sẽ được tối ưu nhất.
                     </p>
                  </div>
                  <div class="choose-content-wrap">
                     @php
                        $lazyPh = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC';
                     @endphp
                     @forelse ($homeChooseItems as $chooseItem)
                     <div class="choose-item">
                        <div class="choose-item-icon">
                           <img class="lazy" src="{{ $lazyPh }}" data-src="{{ $chooseItem->icon }}" alt="{{ e($chooseItem->title) }}" loading="lazy">
                        </div>
                        <div class="choose-item-info">
                           <h4>{{ $chooseItem->title }}</h4>
                           <p>{{ $chooseItem->description }}</p>
                        </div>
                     </div>
                     @empty
                     <p class="text-muted small">Nội dung mục &quot;Tại sao chọn&quot; đang được cập nhật.</p>
                     @endforelse
                  </div>
               </div>
            </div>
            <div class="col-lg-6">
               <div class="choose-img wow fadeInRight" data-wow-delay=".25s">
                  <img class="img-1 lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{ env('AWS_R2_URL') }}/frontend/img/choose1.jpg" alt="image">
                  <img class="img-2 lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{ env('AWS_R2_URL') }}/frontend/img/choose2.jpg" alt="image">
                  <img class="img-shape lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{ env('AWS_R2_URL') }}/frontend/img/04.png" alt="image">
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- choose area end -->
  <div class="service-area sa-bg pt-80 pb-80">
   <div class="container">
       <div class="row g-4 align-items-center wow fadeInDown" data-wow-delay=".25s">
           <div class="col-lg-6">
               <div class="site-heading mb-0">
                   <span class="site-title-tagline"><i class="far fa-truck-container"></i> Step by step</span>
                   <h2 class="site-title text-white">Quy trình hồ sơ</h2>
               </div>
           </div>
           <div class="col-lg-6">
               <p class="text-white">
                   Quy trình hồ sơ của chúng tôi được thiết kế để phù hợp với nhu cầu và năng lực của từng học viên, đảm bảo quý khách có thể đạt được các mới trong quá trình học tập và phát triển.
               </p>
           </div>
       </div>
       <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-5 g-4 mt-4 wow fadeInUp" data-wow-delay=".25s">
         @foreach ($bannerads as $key => $item)
           <div class="col">
               <div class="service-item">
                   <span class="count">{{$key+1}}</span>
                   <div class="service-icon">
                       <img src="{{$item->image}}" alt="{{$item->name}}" loading="lazy">
                   </div>
                   <div class="service-content">
                       <h4 class="service-title">
                           {{$item->name}}
                       </h4>
                       <p class="service-text">
                           {!!($item->description)!!}
                       </p>
                   </div>
               </div>
           </div>  
           @endforeach
       </div>
   </div>
</div>
   <!-- counter area end -->
  
   <!-- testimonial-area -->
   @if (count($reviewcus) > 0)
   <div class="testimonial-area ts-bg pt-80 pb-60">
      <div class="container">
         <div class="row">
            <div class="col-lg-4">
               <div class="site-heading wow fadeInDown" data-wow-delay=".25s">
                  <span class="site-title-tagline"><i class="fas fa-school"></i> Testimonials</span>
                  <h2 class="site-title text-white">Khách hàng nói gì về VNTALENTHUB </h2>
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
                           <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{url('frontend/img/quote.svg')}}" alt="image">
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
                           <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$item->avatar}}" alt="image">
                        </div>
                        <div class="testimonial-author-info">
                           <h4>{{languageName($item->name)}}</h4>
                           <p class="text-white">{{languageName($item->position)}}</p>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   @endif
   <!-- testimonial-area end -->
   <!-- faq area -->
   <div class="faq-area pt-80">
      <div class="container">
         <div class="row">
            <div class="col-lg-4" style="margin: auto;">
               <div class="faq-content wow fadeInUp" data-wow-delay=".25s">
                  <div class="site-heading mb-3">
                     <span class="site-title-tagline"><i class="fas fa-school"></i> Faq's</span>
                     <h2 class="site-title my-3">Câu hỏi thường gặp</h2>
                  </div>
                  <a href="{{route('faq')}}" class="theme-btn mt-2">Xen thêm câu hỏi</a>
               </div>
            </div>
            @php
            $faq = json_decode($setting->footer_content);
            $ques = 0;
            $faqarr = [];
            foreach ($faq as $key => $value) {
            foreach ($value->fag_detail as $k => $v) {
            $ques++;
            $faqarr[] = $v;
            }
            }
            @endphp
            <div class="col-lg-8">
               <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="accordionExample">
                  @foreach ($faqarr as $key => $item)
                  @if ($key < 4)
                  <div class="accordion-item">
                     <h2 class="accordion-header" id="headingOne-{{$key}}">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                           data-bs-target="#collapseOne-{{$key}}" aria-expanded="{{$key == 0 ? 'true' : 'false'}}" aria-controls="collapseOne-{{$key}}">
                        <span><i class="far fa-question"></i></span> {{$item->name}}
                        </button>
                     </h2>
                     <div id="collapseOne-{{$key}}" class="accordion-collapse collapse"
                        aria-labelledby="headingOne-{{$key}}" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                           {!!$item->content!!}
                        </div>
                     </div>
                  </div>
                  @endif
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- faq area end -->
   <!-- quote area -->
   <div class="quote-area qa-negative py-80" id="contactus">
      <div class="container">
         <div class="quote-content">
            <div class="row g-4">
               <div class="col-lg-8">
                  <div class="quote-form">
                     <div class="quote-header">
                        <h4>Yêu cầu tư vấn dịch vụ</h4>
                        <p class="mt-2 mb-0">
                           <a href="{{ route('customer-leads.create') }}">Mở form thu thập thông tin khách hàng đầy đủ</a>
                        </p>
                        @if (session('success'))
                        <p class="mt-2 mb-0 text-success">{{ session('success') }}</p>
                        @endif
                     </div>
                     <form id="commentform" method="POST" action="{{ route('customer-leads.store') }}">
                        @csrf
                        <input type="hidden" name="quick_form" value="1">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-icon">
                                    <i class="far fa-user-tie"></i>
                                    <input type="text" class="form-control" name="name" placeholder="Họ Tên" value="{{ old('name') }}" required>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-icon">
                                    <i class="far fa-phone"></i>
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" value="{{ old('phone') }}" required>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-icon">
                                    <i class="far fa-envelope"></i>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}">
                                 </div>
                              </div>
                           </div>
                           {{-- <div class="col-md-12">
                              <div class="form-group">
                                 <div class="form-icon">
                                    <i class="far fa-truck"></i>
                                    <select class="select" name="service">
                                       <option value="">Dịch vụ tư vấn</option>
                                       @foreach ($servicehome as $item)
                                       <option value="{{$item->name}}">{{$item->name}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                              </div>
                           </div> --}}
                           <div class="col-md-12 mt-2">
                              <button type="submit" class="theme-btn"><span class="loader ml-15 spin-icon"></span> Gửi yêu cầu</button>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="quote-img">
                     <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{ env('AWS_R2_URL') }}/frontend/img/quote.jpg" alt="image">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- quote area end -->
   <!-- blog-area -->
   @if (count($hotnews) > 0)
   <div class="blog-area pb-80">
      <div class="container">
         <div class="row">
            <div class="col-lg-6 mx-auto">
               <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                  <span class="site-title-tagline"><i class="fas fa-school"></i> Our Blog</span>
                  <h2 class="site-title">Tin tức hoạt động</h2>
                  <div class="heading-divider"></div>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="service-slider owl-carousel">
               @foreach ($hotnews as $item)
               <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                  <div class="blog-item-img">
                     <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                     <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$item->image}}" alt="Thumb">
                     </a>
                     <div class="blog-date">
                        <strong>{{date_format($item->created_at,'d')}}</strong>
                        <span>{{date_format($item->created_at,'M')}}</span>
                     </div>
                  </div>
                  <div class="blog-item-info">
                     <div class="blog-item-meta">
                        <ul>
                           <li><a href="{{route('detailBlog',['slug'=>$item->slug])}}"><i class="far fa-user-circle"></i> By Admin</a></li>
                        </ul>
                     </div>
                     <h4 class="blog-title">
                        <a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a>
                     </h4>
                     <p class="line_2">
                        {{languageName($item->description)}}
                     </p>
                     <a class="theme-btn" href="{{route('detailBlog',['slug'=>$item->slug])}}">Đọc tiếp<i class="fas fa-arrow-right"></i></a>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
   @endif
   <!-- blog-area end -->
   <!-- partner area -->
   @if(count($partner) > 0)
   <div class="partner-area bg pt-60 pb-60">
      <div class="container pb-60">
         <div class="row">
            <div class="col-lg-6 mx-auto">
               <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                  <h2 class="site-title">Đối tác</h2>
                  <div class="heading-divider"></div>
               </div>
            </div>
         </div>
         <div class="partner-wrapper partner-slider owl-carousel owl-theme">
            @foreach ($partner as $item)
            <img class="lazy" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAAJcEhZcwAADsQAAA7EAZUrDhsAAAANSURBVBhXYzh8+PB/AAffA0nNPuCLAAAAAElFTkSuQmCC" data-src="{{$item->image}}" alt="thumb">
            @endforeach
         </div>
      </div>
   </div>
   @endif
   <!-- partner area end -->
</main>
@endsection