@extends('layouts.main.master')
@section('title')
Video học viên
@endsection
@section('description')
Video học viên
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
@push('schema')
@php
   $videoListSchema = [];
   foreach ($video as $idx => $item) {
      $videoLink = trim((string) ($item->link ?? ''));
      if (empty($videoLink)) {
         continue;
      }

      $thumbUrl = !empty($item->image) ? $item->image : null;
      $videoObject = [
         '@type' => 'VideoObject',
         'name' => strip_tags((string) $item->name),
         'description' => strip_tags((string) $item->name),
         'thumbnailUrl' => $thumbUrl ? [$thumbUrl] : [],
         'uploadDate' => optional($item->created_at ?? now())->toAtomString(),
         'contentUrl' => $videoLink,
         'embedUrl' => $videoLink,
      ];
      $videoListSchema[] = [
         '@type' => 'ListItem',
         'position' => $idx + 1,
         'url' => $videoLink,
         'item' => $videoObject,
      ];
   }
   $videoSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Video học viên',
      'itemListElement' => $videoListSchema,
   ];
@endphp
@if(count($videoListSchema) > 0)
<script type="application/ld+json">{!! json_encode($videoSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
@endpush
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Video học viên</li>
           </ul>
       </div>
   </div>
   <div class="blog-area py-80">
      <div class="container">
          <div class="row">
              <div class="col-lg-6 mx-auto">
                  <div class="site-heading text-center wow fadeInDown" data-wow-delay=".25s">
                      <h2 class="site-title">Video học viên tại <span>VNTALENTHUB</span></h2>
                      <div class="heading-divider"></div>
                  </div>
              </div>
          </div>
          @if (count($video) > 0)

             
          <div class="row g-4">
            @foreach ($video as $item)
              <div class="col-md-6 col-lg-4">
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
                      <img src="{{ $thumbUrl }}" alt="{{ $item->name }}">
                      <span class="video-review-play"><i class="fas fa-play"></i></span>
                   </a>
                </div>
                <h4 class="video-review-title">{{ $item->name }}</h4>
             </div>
             @endif
              </div>
              @endforeach
          </div>
          <!-- pagination -->
          <div class="pagination-area">
              {{$video->links()}}
          </div>
          @else 
          <h3>Hiện chưa có video để hiển thị.</h3>
          @endif
          <!-- pagination end -->
      </div>
  </div>
</main>
@endsection