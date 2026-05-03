@extends('layouts.main.master')
@section('title')
Đăng nhập tài khoản tại VNTALENTHUB
@endsection
@section('description')
Đăng nhập tài khoản tại VNTALENTHUB
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')

@endsection
@section('content')
<main class="main">

   <!-- breadcrumb -->
   {{-- <div class="site-breadcrumb" style="background: url(assets/img/breadcrumb/01.jpg)">
       <div class="container">
           <h2 class="breadcrumb-title">Đăng nhập</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Đăng nhập</li>
           </ul>
       </div>
   </div> --}}
   <!-- breadcrumb end -->


   <!-- login area -->
   <div class="auth-area py-120">
       <div class="container">
           <div class="col-md-5 mx-auto">
               <div class="auth-form">
                   <div class="auth-header">
                       <img src="{{$setting->logo}}" alt="">
                       <p>Melden Sie sich mit Ihrem Konto an</p>
                   </div>
                   <form action="{{route('postlogin')}}" method="post">
                       @csrf
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-envelope"></i>
                               <input type="email" class="form-control" placeholder="Email" name="email" required>
                           </div>
                       </div>
                       <div class="form-group">
                           <div class="form-icon">
                               <i class="far fa-key"></i>
                               <input type="password" id="password" class="form-control" placeholder="Passwort" name="password" required>
                               <span class="password-view"><i class="far fa-eye-slash"></i></span>
                           </div>
                       </div>
                       <div class="auth-group">
                           <div class="form-check">
                               <a href="{{route('register')}}" class="form-check-label">
                                 Konto erstellen
                               </a>
                           </div>
                           <a href="{{ route('password.forgot') }}" class="auth-group-link">Passwort vergessen?</a>
                       </div>
                       <div class="auth-btn">
                           <button type="submit" class="theme-btn"><span class="far fa-sign-in"></span> Anmelden</button>
                       </div>
                   </form>
               </div>
           </div>
       </div>
   </div>
   <!-- login area end -->

</main>










@endsection