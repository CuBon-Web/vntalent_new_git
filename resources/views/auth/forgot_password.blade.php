@extends('layouts.main.master')
@section('title')
Quên mật khẩu tại VNTALENTHUB
@endsection
@section('description')
Quên mật khẩu tại VNTALENTHUB
@endsection
@section('content')
<main class="main">
   <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
       <div class="container">
           <h2 class="breadcrumb-title">Quên mật khẩu</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Quên mật khẩu</li>
           </ul>
       </div>
   </div>

   <div class="auth-area py-120">
       <div class="container">
           <div class="col-md-5 mx-auto">
               <div class="auth-form">
                   <div class="auth-header">
                       <p>Nhập email để nhận link đặt lại mật khẩu</p>
                   </div>
                   <form action="{{ route('password.email') }}" method="post">
                       @csrf
                       @if(session('success'))
                           <div class="alert alert-success">{{ session('success') }}</div>
                       @endif
                       @if(session('error'))
                           <div class="alert alert-danger">{{ session('error') }}</div>
                       @endif
                       @if($errors->any())
                           <div class="alert alert-danger">{{ $errors->first() }}</div>
                       @endif
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-envelope"></i>
                               <input type="email" class="form-control" placeholder="Email" name="email" required>
                           </div>
                       </div>
                       <div class="auth-btn">
                           <button type="submit" class="theme-btn">Gửi link đặt lại mật khẩu</button>
                       </div>
                       <div class="auth-group mt-2">
                           <a href="{{ route('login') }}" class="auth-group-link">Quay lại đăng nhập</a>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</main>
@endsection
