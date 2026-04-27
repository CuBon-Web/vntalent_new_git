@extends('layouts.main.master')
@section('title')
Feedback học viên
@endsection
@section('description')
Feedback học viên
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<style>
   .feedback-page {
      background: linear-gradient(180deg, #f7faff 0%, #ffffff 100%);
   }
   .feedback-intro {
      max-width: 760px;
      margin: 0 auto 28px;
      text-align: center;
   }
   .feedback-intro p {
      color: #5f6b7a;
      margin-top: 12px;
      line-height: 1.7;
   }
   .feedback-card {
      background: #fff;
      border-radius: 16px;
      border: 1px solid #e7edf7;
      box-shadow: 0 12px 35px rgba(22, 35, 68, 0.12);
      padding: 22px;
      height: 100%;
      transition: transform .3s ease, box-shadow .3s ease;
   }
   .feedback-card:hover {
      transform: translateY(-6px);
      box-shadow: 0 18px 42px rgba(22, 35, 68, 0.2);
   }
   .feedback-head {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 14px;
   }
   .feedback-avatar {
      width: 58px;
      height: 58px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #edf2fc;
      flex-shrink: 0;
   }
   .feedback-name {
      margin: 0;
      font-size: 18px;
      font-weight: 700;
      color: #162343;
   }
   .feedback-position {
      margin: 2px 0 0;
      font-size: 14px;
      color: #66748d;
   }
   .feedback-content {
      position: relative;
      color: #334156;
      line-height: 1.8;
      font-size: 15px;
      padding-top: 8px;
   }
   .feedback-content::before {
      content: "\201C";
      position: absolute;
      left: -3px;
      top: -10px;
      font-size: 36px;
      color: #d70018;
      opacity: .35;
      font-family: serif;
   }
   .feedback-empty {
      text-align: center;
      background: #fff;
      border: 1px solid #e7ecf6;
      border-radius: 14px;
      padding: 30px 18px;
      color: #5f6b7a;
      font-size: 17px;
   }
   .feedback-pagination {
      margin-top: 30px;
      display: flex;
      justify-content: center;
   }
   @media (max-width: 991px) {
      .feedback-card {
         padding: 18px;
      }
   }
</style>
@endsection
@push('schema')
@php
   $reviewListSchema = [];
   foreach ($feedback as $idx => $item) {
      $reviewListSchema[] = [
         '@type' => 'ListItem',
         'position' => $idx + 1,
         'item' => [
            '@type' => 'Review',
            'author' => [
               '@type' => 'Person',
               'name' => strip_tags((string) languageName($item->name)),
            ],
            'reviewBody' => strip_tags((string) languageName($item->content)),
            'itemReviewed' => [
               '@type' => 'EducationalOrganization',
               'name' => $setting->company ?? config('app.name', 'VnTalent'),
            ],
         ],
      ];
   }
   $reviewSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'ItemList',
      'name' => 'Feedback học viên',
      'itemListElement' => $reviewListSchema,
   ];
@endphp
@if(count($reviewListSchema) > 0)
<script type="application/ld+json">{!! json_encode($reviewSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
@endpush
@section('content')
<main class="main feedback-page">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Feedback học viên</li>
           </ul>
       </div>
   </div>
   <div class="blog-area py-80">
      <div class="container">
          <div class="feedback-intro wow fadeInDown" data-wow-delay=".25s">
             <h2 class="site-title">Feedback học viên tại <span>VNTALENTHUB</span></h2>
             <div class="heading-divider"></div>
             <p>Khám phá cảm nhận thực tế của học viên qua những chia sẻ chân thật về hành trình học tập và cuộc sống tại Đức.</p>
          </div>
          @if (count($feedback) > 0)

             
          <div class="row g-4 feedback-grid">
            @foreach ($feedback as $item)
              <div class="col-md-6 col-lg-4">
                <div class="feedback-card wow fadeInUp" data-wow-delay=".25s">
                   <div class="feedback-head">
                      <img class="feedback-avatar" src="{{ $item->avatar }}" alt="{{ languageName($item->name) }}">
                      <div>
                         <h4 class="feedback-name">{{ languageName($item->name) }}</h4>
                         <p class="feedback-position">{{ languageName($item->position) }}</p>
                      </div>
                   </div>
                   <div class="feedback-content">
                      {!! languageName($item->content) !!}
                   </div>
                </div>
              </div>
              @endforeach
          </div>
          <!-- pagination -->
          <div class="pagination-area feedback-pagination">
              {{$feedback->links()}}
          </div>
          @else 
          <div class="feedback-empty">
             Hiện chưa có feedback để hiển thị.
          </div>
          @endif
          <!-- pagination end -->
      </div>
  </div>
</main>
@endsection