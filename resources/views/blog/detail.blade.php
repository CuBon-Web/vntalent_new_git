@extends('layouts.main.master')
@section('title')
{{languageName($blog_detail->title)}}
@endsection
@section('description')
{{languageName($blog_detail->description)}}
@endsection
@section('image')
{{url(''.$blog_detail->image)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@push('schema')
@php
   $articleSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'Article',
      'headline' => languageName($blog_detail->title),
      'description' => strip_tags((string) languageName($blog_detail->description)),
      'image' => [url('' . $blog_detail->image)],
      'datePublished' => optional($blog_detail->created_at)->toAtomString(),
      'dateModified' => optional($blog_detail->updated_at ?? $blog_detail->created_at)->toAtomString(),
      'author' => [
         '@type' => 'Person',
         'name' => 'Admin',
      ],
      'publisher' => [
         '@type' => 'Organization',
         'name' => $setting->company ?? config('app.name', 'VnTalent'),
         'logo' => [
            '@type' => 'ImageObject',
            'url' => $setting->logo ?? url('frontend/img/logo.png'),
         ],
      ],
      'mainEntityOfPage' => url()->current(),
   ];
   $breadcrumbSchema = [
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
            'name' => 'Tin tức',
            'item' => route('allListBlog'),
         ],
         [
            '@type' => 'ListItem',
            'position' => 3,
            'name' => languageName($blog_detail->title),
            'item' => url()->current(),
         ],
      ],
   ];
@endphp
<script type="application/ld+json">{!! json_encode($articleSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
<script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@section('content')
<main class="main">
   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
      <div class="container">
         <ul class="breadcrumb-menu">
            <li><a href="{{route('home')}}">Trang chủ</a></li>
            <li class="active">{{languageName($blog_detail->title)}} </li>
         </ul>
      </div>
   </div>
   <div class="blog-single py-80">
      <div class="container">
         <div class="row g-4">
            <div class="col-lg-8">
               <div class="blog-single-wrap">
                  <div class="blog-single-content">
                     <div class="blog-thumb-img">
                        <img class="w-100" src="{{$blog_detail->image}}"  alt="thumb">
                     </div>
                     <div class="blog-info">
                        <div class="blog-meta">
                           <div class="blog-meta-left">
                              <ul>
                                 <li><i class="far fa-user"></i><a href="#">Admin</a></li>
                                 <li><i class="far fa-calendar"></i>{{date_format($blog_detail->created_at,'d/m/Y')}}</li>
                              </ul>
                           </div>
                        </div>
                        <div class="blog-details service-details">
                           <h1 class="blog-details-title mb-20 title-content">{{languageName($blog_detail->title)}}</h1>
                           <div class="content">
                              {!!languageName($blog_detail->content)!!}
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
                              <div class="row">
                                 <div class="blog-lq-slider owl-carousel">
                                    @foreach ($bloglq as $item)
                                    <div class="blog-item wow fadeInUp" data-wow-delay=".25s">
                                       <div class="blog-item-img">
                                          <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                                             <img src="{{$item->image}}" alt="Thumb">
                                          </a>
                                       </div>
                                       <div class="blog-item-info">
                                          <div class="blog-item-meta">
                                             <ul>
                                                <li><a href="{{route('detailBlog',['slug'=>$item->slug])}}"><i class="far fa-user-circle"></i> By Admin</a></li>
                                                <li><a href="{{route('detailBlog',['slug'=>$item->slug])}}"><i class="far fa-calendar"></i> {{date_format($item->created_at,'d/m/Y')}}</a></li>
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
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <aside class="blog-sidebar">
                  <div class="widget recent-post">
                     <h5 class="widget-title">Bài viết mới</h5>
                     @foreach ($blognew as $item)
                     <div class="recent-post-item">
                        <div class="recent-post-img">
                           <a href="{{route('detailBlog',['slug'=>$item->slug])}}">
                              <img src="{{$item->image}}" alt="thumb">
                           </a>
                           
                        </div>
                        <div class="recent-post-info">
                           <h6><a href="{{route('detailBlog',['slug'=>$item->slug])}}">{{languageName($item->title)}}</a></h6>
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