<footer class="footer-area">
   <div class="footer-shape">
      <img src="https://live.themewild.com/logisto/assets/img/shape/01.png" alt="Footer shape" loading="lazy">
   </div>
   <div class="footer-widget">
      <div class="container">
         <div class="footer-widget-wrap pt-100 pb-80">
            <div class="row g-4">
               <div class="col-lg-4">
                  <div class="footer-widget-box about-us">
                     <a href="#" class="footer-logo">
                     <img src="{{$setting->fbPixel}}" alt="Logo {{$setting->company ?? config('app.name')}}" loading="lazy">
                     </a>
                     <p class="mb-4">
                        {{$setting->webname}}
                     </p>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="footer-widget-box list">
                     <h4 class="footer-widget-title">Chính sách & điều khoản</h4>
                     <ul class="footer-list">
                        @foreach ($pageContent as $item)
                        @if ($item->type === 'ho-tro-khanh-hang')
                        <li><a href="{{route('pagecontent',['slug'=>$item->slug])}}"><i class="far fa-angle-double-right"></i>{{$item->title}}</a></li>
                        @endif
                        @endforeach
                     </ul>
                  </div>
               </div>
               <div class="col-lg-4">
                  <div class="footer-widget-box">
                     <h4 class="footer-widget-title">Thông tin</h4>
                     <ul class="footer-contact">
                        {{-- <li>
                           <div class="icon">
                              <i class="far fa-location-dot"></i>
                           </div>
                           <div class="content">
                              <h6>Địa chỉ</h6>
                              <p>{{$setting->address1}}</p>
                           </div>
                        </li> --}}
                        <li>
                           <div class="icon">
                              <i class="far fa-phone"></i>
                           </div>
                           <div class="content">
                              <h6>Hotline</h6>
                              <a href="tel:{{$setting->phone1}}">{{$setting->phone1}}</a>
                           </div>
                        </li>
                        <li>
                           <div class="icon">
                              <i class="far fa-envelope"></i>
                           </div>
                           <div class="content">
                              <h6>Email</h6>
                              <a href="mailto:{{$setting->email}}">{{$setting->email}}</a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="container">
      <div class="copyright">
         <div class="row">
            <div class="col-md-12 align-self-center">
               <p class="copyright-text">
                  &copy; Copyright <span id="date"></span> <a href="#">  VNTALENTHUB </a> All Rights Reserved.
               </p>
            </div>
         </div>
      </div>
   </div>
</footer>