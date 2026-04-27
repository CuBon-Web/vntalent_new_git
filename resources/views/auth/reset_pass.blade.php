@extends('layouts.main.master')
@section('title')
Đặt lại mật khẩu tại VNTALENTHUB
@endsection
@section('content')
<main class="main">
   <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
       <div class="container">
           <h2 class="breadcrumb-title">Đặt lại mật khẩu</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{ route('home') }}">Trang chủ</a></li>
               <li class="active">Đặt lại mật khẩu</li>
           </ul>
       </div>
   </div>

   <div class="auth-area py-120">
       <div class="container">
           <div class="col-md-5 mx-auto">
               <div class="auth-form">
                   <div class="auth-header">
                       <p>Nhập mật khẩu mới cho tài khoản của bạn</p>
                   </div>
                   <form action="" method="post">
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
                               <input type="email" class="form-control" value="{{ $email }}" disabled>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-key"></i>
                               <input type="password" class="form-control" name="new_password" placeholder="Nhập mật khẩu mới" required>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-key"></i>
                               <input type="password" class="form-control" name="new_password_confirmation" placeholder="Nhập lại mật khẩu mới" required>
                           </div>
                       </div>
                       <div class="auth-btn">
                           <button type="submit" class="theme-btn">Thay đổi mật khẩu</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
</main>
@endsection