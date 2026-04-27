@extends('layouts.main.master')
@section('title')
Đăng ký tài khoản tại VNTALENTHUB
@endsection
@section('description')
Đăng ký tài khoản tại VNTALENTHUB
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
@endsection
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
       <div class="container">
           <h2 class="breadcrumb-title">Đăng ký</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Đăng ký</li>
           </ul>
       </div>
   </div>
   <!-- breadcrumb end -->


   <!-- login area -->
   <div class="auth-area py-120">
       <div class="container">
           <div class="col-md-5 mx-auto">
               <div class="auth-form">
                   <div class="auth-header">
                       <img src="{{$setting->logo}}" alt="">
                       <p>Đăng ký tài khoản tại VNTALENTHUB</p>
                   </div>
                   <form action="{{route('postRegister')}}" method="post">
                       @csrf
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-user"></i>
                               <input type="text" class="form-control" placeholder="Họ và tên" name="name" required>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-envelope"></i>
                               <input type="email" class="form-control" placeholder="Email" name="email" required>
                               @if($errors->has('email'))
                               <span class="text-danger">{{ $errors->first('email') }}</span>
                               @endif
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-phone"></i>
                               <input type="tel" class="form-control" placeholder="Số điện thoại" name="phone" required>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-key"></i>
                               <input type="password" id="password" class="form-control" placeholder="Nhập mật khẩu" name="password" required>
                               @if($errors->has('password'))
                               <span class="text-danger">{{ $errors->first('password') }}</span>
                               @endif
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                              <i class="far fa-key"></i>
                              <input type="password" id="password_confirmation" class="form-control" placeholder="Nhập lại mật khẩu" name="password_confirmation" required>
                              @if($errors->has('password_confirmation'))
                              <span class="text-danger">{{ $errors->first('password_confirmation') }}</span>
                              @endif
                           </div>
                     </div>   
                       <div class="auth-btn">
                           <button type="submit" class="theme-btn"><span class="far fa-sign-in"></span> Đăng ký</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <!-- login area end -->

</main>


@endsection