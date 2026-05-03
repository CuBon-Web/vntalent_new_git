<!-- header area -->
<header class="header">
   <!-- header top -->
   <div class="header-top">
      <div class="container">
         <div class="header-top-wrap">
            <div class="header-top-left">
               <div class="header-top-list">
                  <ul>
                      <li><a href="mailto:{{$setting->email}}"><i class="far fa-envelopes"></i>
                              {{$setting->email}}</a></li>
                      <li><a href="tel:{{$setting->phone1}}"><i class="far fa-phone-volume"></i> {{$setting->phone1}}</a>
                      </li>
                  </ul>
              </div>
            </div>
            <div class="header-top-right">
               <div class="header-top-list">
                  @if(Auth::guard('customer')->check())
                  <a href="{{route('logout')}}"><i class="far fa-sign-out"></i> Logout</a>
                  @else
                  <a href="{{route('login')}}"><i class="far fa-sign-in"></i> Login</a>
                  @endif
              </div>
               <div class="header-top-social">
                  <span>Theo dõi: </span>
                  <a href="{{$setting->facebook}}"><i class="fab fa-facebook"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin"></i></a>
              </div>
            </div>
         </div>
      </div>
   </div>
   <!-- header top end -->
   <!-- navbar -->
   <div class="main-navigation">
      <nav class="navbar navbar-expand-lg">
         <div class="container position-relative">
            <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{$setting->logo}}" alt="Logo {{$setting->company ?? config('app.name')}}" loading="eager" fetchpriority="high">
            </a>
            <div class="mobile-menu-right">
               <div class="nav-btn">
                  <a href="{{route('candidateList')}}" class="theme-btn">DS ứng viên<i
                     class="fas fa-arrow-right"></i></a>
               </div>
               <div class="mobile-menu-btn">
                  <button type="button" class="nav-right-link search-box-outer"><i
                     class="far fa-search"></i></button>
               </div>
               <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                  data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                  aria-label="Toggle navigation">
               <span></span>
               <span></span>
               <span></span>
               </button>
            </div>
            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar"
               aria-labelledby="offcanvasNavbarLabel">
               <div class="offcanvas-header">
                  <a href="{{route('home')}}" class="offcanvas-brand" id="offcanvasNavbarLabel">
                  <img src="{{$setting->logo}}" alt="Logo {{$setting->company ?? config('app.name')}}" loading="lazy">
                  </a>
                  <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"><i
                     class="far fa-xmark"></i></button>
               </div>
               <div class="offcanvas-body gap-xl-4">
                  <ul class="navbar-nav justify-content-end flex-grow-1">
                     <li class="nav-item ">
                        <a class="nav-link active" href="{{route('home')}}">Trang chủ</a>
                        
                     </li>
                     <li class="nav-item"><a class="nav-link" href="{{route('aboutUs')}}">Giới Thiệu</a></li>
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Du học nghề Đức</a>
                        <ul class="dropdown-menu fade-down">
                           @foreach ($servicehome as $item)
                           <li><a class="dropdown-item" href="{{route('serviceCateList',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
                           @endforeach
                        </ul>
                     </li>
                     {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Du học các nước</a>
                        <ul class="dropdown-menu fade-down">
                           @foreach ($duhoccacnuoc as $item)
                           <li class="dropdown-submenu">
                              <a class="dropdown-item dropdown-toggle" href="#">Du học {{$item->name}}</a>
                              <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="{{route('aboutNation',['slug'=>$item->slug])}}">Về nước {{$item->name}}</a></li>
                                 <li><a class="dropdown-item" href="{{route('duhoc',['slug'=>$item->slug])}}">Du học {{$item->name}}</a></li>
                                 <li><a class="dropdown-item" href="{{route('tintucduhoc',['slug'=>$item->slug])}}">Tin tức</a>
                                 </li>
                              </ul>
                           </li>
                           @endforeach
                        </ul>
                     </li> --}}
                     {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Tìm trường</a>
                        <ul class="dropdown-menu fade-down">
                           <li><a class="dropdown-item" href="{{route('bangxephang',['slug'=>'thewu'])}}">Bảng xếp hạng</a>
                           </li>
                           <li><a class="dropdown-item" href="{{route('tracutruong')}}">Tra cứu trường</a>
                           </li>
                        </ul>
                     </li> --}}
                     @foreach ($blogCate as $item)
                     <li class="nav-item dropdown">
                        <a class="nav-link {{count($item->typeCate) > 0 ? 'dropdown-toggle' : ''}} " href="{{route('listCateBlog',['slug'=>$item->slug])}}" @if (count($item->typeCate) > 0) data-bs-toggle="dropdown" @endif>{{languageName($item->name)}}</a>
                        @if (count($item->typeCate) > 0)
                        <ul class="dropdown-menu fade-down">
                           @foreach ($item->typeCate as $type)
                           <li><a class="dropdown-item" href="{{route('listTypeBlog',['slug'=>$type->slug])}}">{{languageName($item->name)}}</a></li>
                           @endforeach
                        </ul>
                        @endif
                        
                     </li>
                     @endforeach
                     {{-- @if (count($videos) > 0 && count($reviewcus) > 0) --}}
                     {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Học Viên</a>
                        <ul class="dropdown-menu fade-down">
                           <li><a class="dropdown-item" href="{{route('videoHocVien')}}">Video học viên</a></li>
                           <li><a class="dropdown-item" href="{{route('feedbackHocVien')}}">Feedback học viên</a></li>
                        </ul>
                     </li> --}}
                     {{-- @endif --}}
                     <li class="nav-item"><a class="nav-link" href="{{route('lienHe')}}">Liên Hệ</a></li>
                  </ul>
                  <!-- nav-right -->
                  <div class="nav-right">
                     <div class="nav-btn">
                        <a href="{{route('candidateList')}}" class="theme-btn">DS ứng viên<i
                           class="fas fa-arrow-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </nav>
   </div>
   <!-- navbar end-->
</header>
<!-- header area end -->
<!-- popup search -->
<div class="search-popup">
   <button class="close-search"><span class="far fa-times"></span></button>
   <form action="#">
      <div class="form-group">
         <input type="search" name="search-field" class="form-control" placeholder="Search Here..." required>
         <button type="submit"><i class="far fa-search"></i></button>
      </div>
   </form>
</div>
<!-- popup search end -->