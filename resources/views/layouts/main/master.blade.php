{{-- https://live.themewild.com/logisto/service.html --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale() ?? 'vi') }}">
   <head>
      @php
         $siteName = $setting->company ?? config('app.name', 'VnTalent');
         $seoTitle = trim($__env->yieldContent('title', $siteName));
         $seoDescription = trim($__env->yieldContent('description', 'Trang chính thức của '.$siteName));
         $seoImage = trim($__env->yieldContent('image', $setting->logo ?? url('frontend/img/logo.png')));
         $canonicalUrl = url()->current();
         $currentPath = request()->path();
         $noindexPaths = ['login.html', 'register.html', 'account/orders', 'gio-hang.html', 'thanh-toan.html'];
         $seoRobots = in_array($currentPath, $noindexPaths, true) ? 'noindex, nofollow' : 'index, follow';
         $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => $siteName,
            'url' => url('/'),
            'logo' => $setting->logo ?? $seoImage,
            'email' => $setting->email ?? null,
            'telephone' => $setting->phone1 ?? null,
            'sameAs' => array_values(array_filter([
               $setting->facebook ?? null,
            ])),
         ];
         $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => $siteName,
            'url' => url('/'),
         ];
         $breadcrumbSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
               [
                  '@type' => 'ListItem',
                  'position' => 1,
                  'name' => 'Trang chủ',
                  'item' => url('/'),
               ],
            ],
         ];
      @endphp
      <meta charset="UTF-8" />
      <meta name="theme-color" content="#d70018">
      <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests" />
      <meta name='revisit-after' content='2 days' />
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>{{ $seoTitle }}</title>
      <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
      <meta http-equiv="Content-Language" content="vi" />
      <link rel="alternate" href="{{ $canonicalUrl }}" hreflang="vi-vn" />
      <link rel="alternate" href="{{ $canonicalUrl }}" hreflang="x-default" />
      <meta name="description" content="{{ $seoDescription }}">
      <meta name="robots" content="{{ $seoRobots }}" />
      <meta name="googlebot" content="{{ $seoRobots }}">
      <meta name="revisit-after" content="1 days" />
      <meta name="generator" content="{{ $siteName }}" />
      <meta name="rating" content="General">
      <meta name="application-name" content="{{ $siteName }}" />
      <meta name="theme-color" content="#ed3235" />
      <meta name="msapplication-TileColor" content="#ed3235" />
      <meta name="mobile-web-app-capable" content="yes">
      <meta name="mobile-web-app-title" content="{{ $siteName }}" />
      <link rel="touch-icon-precomposed" href="{{ $seoImage }}" sizes="700x700">
      <meta property="og:url" content="{{ $canonicalUrl }}">
      <meta property="og:title" content="{{ $seoTitle }}">
      <meta property="og:description" content="{{ $seoDescription }}">
      <meta property="og:image" content="{{ $seoImage }}">
      <meta property="og:site_name" content="{{ $siteName }}">
      <meta property="og:image:alt" content="{{ $seoTitle }}">
      <meta property="og:type" content="website" />
      <meta property="og:locale" content="vi_VN" />
      <meta name="twitter:card" content="summary" />
      <meta name="twitter:title" content="{{ $seoTitle }}" />
      <meta name="twitter:description" content="{{ $seoDescription }}" />
      <meta name="twitter:image" content="{{ $seoImage }}" />
      <meta name="twitter:url" content="{{ $canonicalUrl }}" />
      <meta itemprop="name" content="{{ $seoTitle }}">
      <meta itemprop="description" content="{{ $seoDescription }}">
      <meta itemprop="image" content="{{ $seoImage }}">
      <meta itemprop="url" content="{{ $canonicalUrl }}">
      <link rel="canonical" href="{{ $canonicalUrl }}">
      <!-- <link rel="amphtml" href="amp/" /> -->
      <link rel="image_src" href="{{ $seoImage }}" />
      <link rel="shortcut icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
      <link rel="icon" href="{{url(''.$setting->favicon)}}" type="image/x-icon">
      <meta name="csrf-token" content="{{ csrf_token() }}" />
      <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
      <script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
      <script type="application/ld+json">{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
      @stack('schema')
      <!-- css -->
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/bootstrap.min.css">
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/all-fontawesome.min.css">
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/animate.min.css">
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/magnific-popup.min.css">
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/owl.carousel.min.css">
      <link rel="stylesheet" href="{{ env('AWS_R2_URL') }}/frontend/css/nice-select.min.css">
      <link rel="stylesheet" href="/frontend/css/style.css"> 
      <link rel="stylesheet" href="/frontend/css/callbutton.css">
      <link rel="stylesheet" href="/frontend/css/notify.css">
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/jquery-3.7.1.min.js" defer></script>
      <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js" defer></script>
      @yield('css')
   </head>
   <body>
      @include('layouts.header.index')
      
      @yield('content')
      <!-- footer area -->
      @include('layouts.footer.index')

      @if(Session::has('success'))
      <div class="lobibox-notify-wrapper top right">
         <div class="lobibox-notify lobibox-notify-success animated-fast fadeInDown without-icon notify-mini" style="width: 368px;">
               <div class="lobibox-notify-icon-wrapper">
                  <div class="lobibox-notify-icon">
                     <div></div>
                  </div>
               </div>
               <div class="lobibox-notify-body">
                  <div class="lobibox-notify-msg" style="max-height: 32px;">{{ Session::get('success') }}</div>
               </div>
               <span class="lobibox-close" onclick="$('.lobibox-notify-wrapper').remove()">×</span>
         </div>
      </div>
      @endif
      @if(Session::has('error'))
      <div class="lobibox-notify-wrapper top right">
         <div class="lobibox-notify lobibox-notify-error animated-fast fadeInDown without-icon notify-mini" style="width: 368px;">
               <div class="lobibox-notify-icon-wrapper">
                  <div class="lobibox-notify-icon">
                     <div></div>
                  </div>
               </div>
               <div class="lobibox-notify-body">
                  <div class="lobibox-notify-msg" style="max-height: 32px;">{{ Session::get('error') }}</div>
               </div>
               <span class="lobibox-close" onclick="$('.lobibox-notify-wrapper').remove()">×</span>
         </div>
      </div>
      @endif
      <div class="notify bar-top do-show" >
      </div>
      <!-- footer area end -->
      <div onclick="window.location.href= 'tel:{{$setting->phone1}}'" class="hotline-phone-ring-wrap">
         <div class="hotline-phone-ring">
            <div class="hotline-phone-ring-circle"></div>
            <div class="hotline-phone-ring-circle-fill"></div>
            <div class="hotline-phone-ring-img-circle">
               <a href="tel:{{$setting->phone1}}" class="pps-btn-img">
                  <img src="{{url('frontend/img/phone.png')}}" alt="Gọi điện thoại" width="50" loading="lazy">
               </a>
            </div>
         </div>
         <a href="tel:{{$setting->phone1}}">
         </a>
         <div class="hotline-bar"><a href="tel:{{$setting->phone1}}">
            </a><a href="tel:{{$setting->phone1}}">
               <span class="text-hotline">{{$setting->phone1}}</span>
            </a>
         </div>
   
      </div>
      <div class="inner-fabs">
         <a target="blank" href="{{$setting->facebook}}" class="fabs roundCool"
            id="challenges-fab" data-tooltip="Nhắn tin facebook">
            <img class="inner-fab-icon" src="{{url('frontend/img/messenger-icon.png')}}" alt="Messenger" border="0" loading="lazy">
         </a>
         <a target="blank" href="https://zalo.me/{{$setting->phone1}}" class="fabs roundCool" id="chat-fab"
            data-tooltip="Nhắn tin Zalo">
            <img class="inner-fab-icon" src="{{url('frontend/img/zalo.png')}}" alt="Zalo" border="0" loading="lazy">
         </a>
        
      </div>
      <div class="fabs roundCool call-animation" id="main-fab">
         <img class="img-circle" src="{{url('frontend/img/lienhe.png')}}" alt="Liên hệ" width="135" loading="lazy">
      </div>
      <div class="totop">
         <a href="#"><i class="bi bi-chevron-up"></i></a>
      </div>
      
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/modernizr.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/bootstrap.bundle.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/imagesloaded.pkgd.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/jquery.magnific-popup.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/isotope.pkgd.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/jquery.appear.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/jquery.easing.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/owl.carousel.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/counter-up.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/jquery.nice-select.min.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/wow.min.js" defer></script>
      <script src="/frontend/js/main.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/callbutton.js" defer></script>
      <script src="{{ env('AWS_R2_URL') }}/frontend/js/notify.min.js" defer></script>
      <script src="/frontend/js/notify.js" defer></script>
      <script src="/frontend/js/anti-copy.js" defer></script>
      @yield('js')
   </body>
</html>