@extends('layouts.main.master')
@section('title')
{{($product->name)}}
@endsection
@section('description')
{{languageName($product->description)}}
@endsection
@section('image')
@php
$img = json_decode($product->images);
$thongso = json_decode($product->size);
$caphoc = json_decode($product->preserve);
$nghanhhoc = json_decode($product->tags);
@endphp
{{url(''.$img[0])}}
@endsection
@section('css')
<style>
.process-item .icon {
    width: 200px;
    height: auto;
   } 
   .blog-item-meta ul li {
      display: block;
      }
      .service-sidebar {
    position: sticky;
    top: 80px;
}
.rank ul {
   margin: 0!important;
   display: flex;
   width: 100%;
   flex-wrap: wrap;
}
.rank ul li {
    list-style: none!important;
    width: 46%;
}

p.tittle-chi {
    margin-bottom: 0;
}
.process-item .content h4 {
    color: var(--color-dark);
    font-size: 18px;
    margin-bottom: 0;
    font-weight: 600;
    text-transform: uppercase;
}
@media (max-width: 991px) {
    .rank ul li {
        width: 100%;
    }
}
</style>
@endsection
@section('js')
@endsection
@section('content')
<div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
   <div class="container">
      <h2 class="breadcrumb-title">{{($product->name)}}</h2>
      <ul class="breadcrumb-menu">
         <li><a href="{{route('home')}}">Trang chủ</a></li>
         <li class="active">{{($product->name)}}</li>
      </ul>
   </div>
</div>
<div class="service-single pt-40">
   <div class="container">
      <div class="service-single-wrap">
         <div class="row">
            <div class="col-xl-12 col-lg-12">
               <div class="row">
                  <div class="col-lg-12 col-xl-12 col-md-12 col-12">
                     <div class="process-item mb-4">
                        <div class="icon">
                           <a href="" class="w-100 h-100">
                           <img src="{{$img[0]}}" alt="">
                           </a>
                        </div>
                        <div class="content">
                           <a href="">
                              <h4>{{($product->name)}}</h4>
                           </a>
                           <div class="blog-item-meta">
                              <ul style="border-bottom: none;">
                                 <li><i class="far fa-location-pin"></i>
                                    {{languageName($product->cate->name)}}
                                 </li>
                                 <li><i class="far fa-graduation-cap"></i>Bậc Học: 
                                    <b>Dự bị đại học</b>
                                    <b>Đại Học</b>
                                 </li>
                                 <li><i class="far fa-money-bill"></i> Học phí trung bình (tham khảo): <strong>{{number_format($product->price)}}$</strong></li>
                                 <li><a href=""><i class="far fa-eye"></i> 1.2k view</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="service-single py-40">
   <div class="container">
      <div class="service-single-wrap">
         <div class="row">
            <div class="col-xl-8 col-lg-8">
               <div class="service-details">
                  <div class="content">
                     <h2 class="mb-20 title-univer">Tổng Quan</h2>
                     {!!languageName($product->content)!!}
                  </div>
                  <div class="content pt-40">
                     <h2 class="mb-20 title-univer">Các nghành học tại {{($product->name)}}</h2>
                     <div class="blog-comments">
                        <div class="description_detail_product">
                           <ul>
                                 @foreach ($nghanhhoc as $item)
                                 @php
                                     $tagitem = \DB::table('tags')->where('id',$item)->first();
                                 @endphp
                                 <li>
                                    <div>
                                       <img width="30" src="{{$tagitem->image}}" alt=""> <span>
                                          {{$tagitem->name}}</span>
                                    </div>
                                  </li>
                                 @endforeach
                            </ul>
                        </div>
                     </div>
                  </div>
                  <div class="content pt-40">
                     <h2 class="mb-20 title-univer">Điểm nổi bật tại {{($product->name)}}</h2>
                     <h4>Xếp hạng</h4>
                     <hr>
                     <p class="mb-10"><strong >Hotcourses Diversity Index</strong></p>
                     
                     <div class="blog-comments">
                        <div class="rank">
                           <ul>
                                 <li>
                                    <div>
                                       <p class="tittle-chi">CHỈ SỐ ĐA DẠNG</p>
                                       <p>
                                          <strong style="font-size: 28px">
                                             {{$product->thickness}}
                                          </strong> quốc tịch của sinh viên quốc tế
                                       </p>
                                       
                                    </div>
                                  </li>
                                  <li>
                                    <div>
                                       <p class="tittle-chi">CHỈ SỐ ĐỒNG HƯƠNG</p>
                                       <p>
                                          <strong style="font-size: 28px">
                                             {{$product->hang_muc}}%
                                          </strong> sinh viên quôc tế mang quốc tich Việt Nam
                                       </p>
                                       
                                    </div>
                                  </li>
                            </ul>
                        </div>
                     </div>
                     <hr>
                     <p class="mb-10"><strong >Bảng xếp hạng Times Higher Education: <span style="font-size: 28px">{{$product->ingredient}}</span></strong></p>
                     <div class="skill-area">
                        <div class="skill-content wow fadeInUp" data-wow-delay=".25s">
                           <div class="skill-progress">
                              @foreach ($thongso as $item)
                              <div class="progress-item">
                                 <h5>{{$item->title}} <span class="percent">{{$item->detail}}%</span></h5>
                                 <div class="progress" data-value="{{$item->detail}}">
                                     <div class="progress-bar" role="progressbar"></div>
                                 </div>
                             </div>
                              @endforeach
                           </div>
                       </div>
                     </div>
                     <hr>
                     <div class="blog-comments">
                        <div class="rank">
                           <ul>
                                 <li>
                                    <div>
                                       <p class="tittle-chi">Bảng xếp hạng QS</p>
                                       <p>
                                          <strong style="font-size: 28px">
                                             {{$product->species}}
                                          </strong> 
                                       </p>
                                       
                                    </div>
                                  </li>
                                  <li>
                                    <div>
                                       <p class="tittle-chi">Bảng xếp hạng ARWU</p>
                                       <p>
                                          <strong style="font-size: 28px">
                                             {{$product->origin}}
                                          </strong> 
                                       </p>
                                       
                                    </div>
                                  </li>
                            </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-lg-4">
               <div class="service-sidebar">
                  @include('layouts.main.sidebar')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection