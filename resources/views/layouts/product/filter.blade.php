@foreach ($product as $item)
@php
    $bachoc = json_decode($item->preserve);
    $img = json_decode($item->images);
@endphp
<div class="col-lg-12 col-xl-12 col-md-12 col-12">
                        
    <div class="process-item mb-4">
     <div class="icon">
        <a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}" class="w-100 h-100">
           <img src="{{$img[0]}}" alt="">
        </a>
        
    </div>
    @if ($rank == '')
    @endif
    @if ($rank == 'thewu')
    <span class="count">{{$item->ingredient}}</span>
    @endif
    @if ($rank == 'qswu')
    <span class="count">{{$item->species}}</span>
    @endif
    @if ($rank == 'arowu')
    <span class="count">{{$item->origin}}</span>
    @endif
     <div class="content">
        <a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}">
           <h4>{{$item->name}}</h4>
        </a>
         <div class="blog-item-meta">
           <ul style="border-bottom: none;">
               <li><a href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}"><img width="30" src="{{$item->cate->avatar}}" alt=""> {{languageName($item->cate->name)}}</a></li>
               <li><a class="bachoc" href="{{route('detailProduct',['cate'=>$item->cate_slug,'type'=>$item->type_slug ? $item->type_slug : 'loai','id'=>$item->slug])}}">Bậc Học: 
                 @foreach ($bachoc as $item)
                 @if ($item == 'thpt')
                 <b>THPT</b>
                 @elseif($item == 'cao-dang')
                 <b>Cao Đẳng</b>
                 @elseif($item == 'du-bi-dai-hoc')
                 <b>Dự bị đại học</b>
                 @elseif($item == 'dai-hoc')
                 <b>Đại Học</b>
                 @elseif($item == 'sau-dai-hoc')
                 <b>Sau đại học</b>
                 @elseif($item == 'hoc-tieng')
                 <b>Học Tiếng</b>
                 @else 
                 <b>Học Nghề</b>
                 @endif
                 @endforeach 
                </a></li>
               <li><a href=""><i class="far fa-eye"></i> 1.2k Comments</a></li>
           </ul>
       </div>
     </div>
 </div>
  
</div>
@endforeach
<div class="col-lg-12 col-xl-12 col-md-12 col-12">
    <div id="pagination_main" style="text-align: center;">
       {{$product->links()}}
    </div>
 </div>
