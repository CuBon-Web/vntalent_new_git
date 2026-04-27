@extends('layouts.main.master')
@section('title')
Câu hỏi thường gặp
@endsection
@section('description')
Câu hỏi thường gặp
@endsection
@section('image')
{{url('frontend/images/12.jpg')}}
@endsection
@section('css')
@endsection
@section('js')
@endsection
@push('schema')
@php
    $faqRaw = json_decode($setting->footer_content);
    $faqEntities = [];
    if (is_array($faqRaw) || is_object($faqRaw)) {
        foreach ($faqRaw as $group) {
            if (!empty($group->fag_detail) && is_array($group->fag_detail)) {
                foreach ($group->fag_detail as $qa) {
                    if (!empty($qa->name) && !empty($qa->content)) {
                        $faqEntities[] = [
                            '@type' => 'Question',
                            'name' => strip_tags((string) $qa->name),
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => strip_tags((string) $qa->content),
                            ],
                        ];
                    }
                }
            }
        }
    }
    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faqEntities,
    ];
@endphp
@if(count($faqEntities) > 0)
<script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
@endif
@endpush
@section('content')
<main class="main">

   <!-- breadcrumb -->
   <div class="site-breadcrumb" style="background: url({{url('frontend/img/breadcrumb.jpg')}})">
       <div class="container">
           <h2 class="breadcrumb-title">Câu hỏi thường gặp</h2>
           <ul class="breadcrumb-menu">
               <li><a href="{{route('home')}}">Trang chủ</a></li>
               <li class="active">Câu hỏi thường gặp</li>
           </ul>
       </div>
   </div>
   <!-- breadcrumb end -->
   <div class="faq-area py-40">
      <div class="container">
          <div class="row">
            @php
                $faq = json_decode($setting->footer_content);
            @endphp
              <div class="col-lg-12">
                  <div class="accordion wow fadeInRight" data-wow-delay=".25s" id="accordionExample">
                     @foreach ($faq as $value)
                     @foreach ($value->fag_detail as $key => $item)
                     <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne-{{$key}}">
                           <button class="accordion-button {{$key != 0 ? 'collapsed' : ''}}" type="button" data-bs-toggle="collapse"
                              data-bs-target="#collapseOne-{{$key}}" aria-expanded="{{$key == 0 ? 'true' : 'false'}}" aria-controls="collapseOne-{{$key}}">
                           <span><i>{{$key+1}}</i></span> {{$item->name}}
                           </button>
                        </h2>
                        <div id="collapseOne-{{$key}}" class="accordion-collapse collapse {{$key == 0 ? 'show' : ''}}"
                           aria-labelledby="headingOne-{{$key}}" data-bs-parent="#accordionExample">
                           <div class="accordion-body">
                              {!!$item->content!!}
                           </div>
                        </div>
                     </div>
                     @endforeach
                     
                     @endforeach
                  </div>
              </div>
          </div>
      </div>
  </div>
</main>
@endsection