@extends('layouts.main.master')
@section('title')
{{($detail_service->name)}}
@endsection
@section('description')
{{($detail_service->description)}}
@endsection
@section('image')
{{url(''.$detail_service->image)}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@section('content')
<section id="ft-breadcrumb" class="ft-breadcrumb-section position-relative" data-background="{{url('frontend/img/bread-bg.jpg')}}" style="background-image: url(&quot;{{url('frontend/img/bread-bg.jpg')}}&quot;);">
   <span class="background_overlay"></span>
   <span class="design-shape position-absolute"><img src="{{url('frontend/img/tmd-sh.png')}}" alt=""></span>
   <div class="container">
      <div class="ft-breadcrumb-content headline text-center position-relative">
         <h1>{{($detail_service->name)}}</h1>
         <div class="ft-breadcrumb-list ul-li">
            <ul>
               <li><a href="{{route('home')}}">Home</a></li>
               <li>Dịch Vụ</li>
               <li>{{($detail_service->name)}}</li>
            </ul>
         </div>
      </div>
   </div>
</section>
<section id="ft-service-details" class="ft-service-details-section page-padding">
   <div class="container">
      <div class="ft-service-details-content">
         <div class="row">
            
            <div class="col-lg-8">
               <div class="ft-service-details-content-wrapper headline pera-content">
                  <div class="ft-service-details-text-wrapper">
                     <h3>Thông Tin Chi Tiết: </h3>
                     {!!languageName($detail_service->content)!!}
                  </div>
               </div>
            </div>
            <div class="col-lg-4">
               <div class="ft-service-sidebar">
                  <div class="ft-service-sidebar-widget headline ul-li-block">
                     <div class="service-category-widget">
                        <h3 class="widget-title">Tất Cả Dịch Vụ</h3>
                        <ul>
                           @foreach ($servicehome as $item)
                           <li><a href="{{route('serviceDetail',['slug'=>$item->slug])}}">{{$item->name}}</a></li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
                  <div class="ft-service-sidebar-widget headline ul-li-block">
                     <div class="service-form-widget">
                        <h3 class="widget-title text-uppercase">ĐĂNG KÝ TƯ VẤN</h3>
                        <p>Hỗ Trợ 24/7</p>
                        <form id="baogiadervice">
                           <input type="text" name="name" placeholder="Họ Tên">
                           <input hidden type="text" name="service" value="{{($detail_service->name)}}">
                           <input type="text" name="phone" placeholder="Số Điện Thoại">
                           <input type="text" name="tenhang" placeholder="Tên Hàng">
                           <input type="text" name="khoiluong" placeholder="Khối Lượng">
                           <input type="text" name="diemboc" placeholder="Điểm bốc">
                           <input type="text" name="diemtra" placeholder="Điểm trả">
                           <input type="text" name="ngaycanchuyen" placeholder="Ngày cần chuyển">
                           <input type="text" name="cuocdexuat" placeholder="Cước đề xuất">
                           <button type="submit"><i class="fa fa-spinner fa-spin spin-icon" aria-hidden="true"></i> Nhận Báo Giá</button>
                        </form>
                        <script>
                           $('#baogiadervice').validate({
                                       rules: {
                                          "name": {
                                             required: true,
                                          },
                                          "phone": {
                                             required: true,
                                             minlength: 8
                                          },
                                          "tenhang": {
                                             required: true,
                                          },
                                          "khoiluong": {
                                             required: true,
                                          },
                                          "diemboc": {
                                             required: true,
                                          },
                                          "diemtra": {
                                             required: true,
                                          },
                                          "ngaycanchuyen": {
                                             required: true,
                                          }
                                       },
                                       messages: {
                                          "name": {
                                             required: "Tên bạn là gì?",
                                          },
                                          "phone": {
                                             required: "Nhập sdt liên hệ",
                                          },
                                          "tenhang": {
                                             required: "Hàng bạn muốn vận chuyển là gì?",
                                          },
                                          "khoiluong": {
                                             required: "Khối lượng hàng khoảng bao nhiêu?",
                                          },
                                          "diemboc": {
                                             required: "Điểm bốc hàng của bạn là gì?",
                                          },
                                          "diemtra": {
                                             required: "Điểm trả hàng của bạn là gì?",
                                          },
                                          "ngaycanchuyen": {
                                             required: "Ngày bạn cần chuyển hàng?",
                                          }
                                       },
                                    submitHandler: function(form) {
                                       $(".spin-icon").css("display", "block");
                                       $.ajax({
                                        url: "https://script.google.com/macros/s/AKfycbxOY64wKFA2hVQa5gnXd9ZvXYigvKkpGdl9Plh3eZSAo0grZjiEZqm6PelpkMU5lKt3/exec",
                                        type: "post",
                                        data: $("#baogiadervice").serializeArray(),
                                        success: function () {
                                           $(".spin-icon").css("display", "none");
                                          jQuery.notify("Thành công! Chúng tôi sẽ sớm liên hệ", "success");
                                        },
                                        error: function () {
                                          jQuery.notify("Gửi thông tin thất bại", "error");
                                        }
                                     });
                                    }
                                    });
                        </script>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection