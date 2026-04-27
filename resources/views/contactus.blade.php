@extends('layouts.main.master')
@section('title')
Liên hệ với chúng tôi
@endsection
@section('description')
Liên hệ với chúng tôi
@endsection
@section('image')
{{url(''.$setting->logo)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@push('schema')
@php
   $contactSchema = [
      '@context' => 'https://schema.org',
      '@type' => 'ContactPage',
      'name' => 'Liên hệ ' . ($setting->company ?? config('app.name', 'VnTalent')),
      'url' => url()->current(),
      'mainEntity' => [
         '@type' => 'Organization',
         'name' => $setting->company ?? config('app.name', 'VnTalent'),
         'url' => url('/'),
         'telephone' => $setting->phone1 ?? null,
         'email' => $setting->email ?? null,
         'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $setting->address1 ?? null,
            'addressCountry' => 'VN',
         ],
      ],
   ];
@endphp
<script type="application/ld+json">{!! json_encode($contactSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endpush
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <h2 class="breadcrumb-title">Liên hệ</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Liên hệ</li>
           </ul>
       </div>
   </div>
   <div class="contact-area py-120">
      <div class="container">
          <div class="contact-content">
              <div class="row">
                  <div class="col-md-3">
                      <div class="contact-info">
                          <div class="icon">
                              <i class="fal fa-map-location-dot"></i>
                          </div>
                          <div class="content">
                              <h5>Địa chỉ</h5>
                              <p>{{$setting->address1}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="contact-info">
                          <div class="icon">
                              <i class="fal fa-phone-volume"></i>
                          </div>
                          <div class="content">
                              <h5>Hotline</h5>
                              <p>{{$setting->phone1}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="contact-info">
                          <div class="icon">
                              <i class="fal fa-envelopes"></i>
                          </div>
                          <div class="content">
                              <h5>Email</h5>
                              <p>{{$setting->email}}</p>
                          </div>
                      </div>
                  </div>
                  <div class="col-md-3">
                      <div class="contact-info">
                          <div class="icon">
                              <i class="fal fa-alarm-clock"></i>
                          </div>
                          <div class="content">
                              <h5>Open Time</h5>
                              <p>T2 - T7 (8.30AM - 05.30PM)</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="contact-form-wrap">
              <div class="row g-4">
                  <div class="col-lg-5">
                      <div class="contact-img">
                          <img src="{{url('frontend/img/contact.jpg')}}" alt="Liên hệ {{$setting->company ?? config('app.name')}}" loading="lazy">
                      </div>
                  </div>
                  <div class="col-lg-7">
                      <div class="contact-form">
                          <div class="contact-form-header">
                              <h2>Gửi lời nhắn</h2>
                          </div>
                          <div class="form-message"></div>
                          <form  action="{{route('postcontact')}}" method="POST" id="contact-form">
                           @csrf
                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <div class="form-icon">
                                              <i class="far fa-user-tie"></i>
                                              <input type="text" class="form-control" name="name" placeholder="Họ Tên" required>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-6">
                                      <div class="form-group">
                                          <div class="form-icon">
                                              <i class="far fa-envelope"></i>
                                              <input type="email" class="form-control" name="email" placeholder="Email">
                                          </div>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="form-icon">
                                      <i class="far fa-pen"></i>
                                      <input type="text" class="form-control" name="phone" placeholder="Số điện thoại" required>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <div class="form-icon">
                                      <i class="far fa-comment-lines"></i>
                                      <textarea name="message" cols="30" rows="5" class="form-control"
                                          placeholder="Lời nhắn cho chúng tôi"></textarea>
                                  </div>
                              </div>
                              <button type="submit" class="theme-btn">Gửi thông tin<i class="far fa-paper-plane"></i></button>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- end contact area -->


  <!-- map -->
  <div class="contact-map">
      {!!$setting->iframe_map!!}
  </div>
  <!-- map end -->
</main>
@endsection