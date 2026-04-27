@extends('layouts.main.master')
@section('title')
{{$detail_service->name}}
@endsection
@section('description')
{{languageName($detail_service->description)}}
@endsection
@section('image')
{{url(''.$detail_service->image)}}
@endsection
@section('css')
<style>
   .service-sidebar {
    position: sticky;
    top: 80px;
}
</style>
@endsection
@section('js')


@endsection
@push('schema')
@php
   $serviceSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'Service',
      'name' => strip_tags((string) $detail_service->name),
      'description' => strip_tags((string) languageName($detail_service->description)),
      'provider' => [
         '@type' => 'Organization',
         'name' => $setting->company ?? config('app.name', 'VnTalent'),
         'url' => url('/'),
      ],
      'url' => url()->current(),
      'image' => !empty($detail_service->image) ? [url('' . $detail_service->image)] : [],
   ];
   $serviceBreadcrumb = [
      '@context' => 'https://schema.org',
      '@type' => 'BreadcrumbList',
      'itemListElement' => [
         [
            '@type' => 'ListItem',
            'position' => 1,
            'name' => 'Trang chủ',
            'item' => route('home'),
         ],
         [
            '@type' => 'ListItem',
            'position' => 2,
            'name' => 'Dịch vụ',
            'item' => url()->current(),
         ],
      ],
   ];
@endphp
<script type="application/ld+json">{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($serviceBreadcrumb, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <h2 class="breadcrumb-title">{{$detail_service->name}}</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">{{$detail_service->name}}</li>
           </ul>
       </div>
   </div>
   <!-- breadcrumb end -->


   <!-- service single -->
   <div class="service-single py-120">
       <div class="container">
           <div class="service-single-wrap">
               <div class="row">
                  <div class="col-xl-8 col-lg-8">
                     <div class="service-details">
                         <div class="content">
                             <h1 class="mb-20 title-content">{{$detail_service->name}}</h1>
                             {!!languageName($detail_service->content)!!}
                         </div>
                     </div>
                 </div>
                   <div class="col-xl-4 col-lg-4">
                       <div class="service-sidebar">
                           <div class="widget">
                               <h4 class="title">Dịch vụ khác</h4>
                               <div class="category">
                                 @foreach ($servicehome as $item)
                                 <a href="{{route('serviceCateList',['slug'=>$item->slug])}}"><i class="far fa-angle-double-right"></i>{{$item->name}}</a>
                                 @endforeach
                               </div>
                           </div>
                           @include('layouts.main.sidebar')
                       </div>
                   </div>
                   
               </div>
           </div>
       </div>
   </div>
   <!-- service single end -->

</main>
@endsection