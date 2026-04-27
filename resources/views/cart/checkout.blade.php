@extends('layouts.main.master')
@section('title')
Đặt bàn tại Lynh
@endsection
@section('description')
Bún đậu mắm tôm Lynh
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<link rel="stylesheet" href="{{url('frontend/css/checkout.vendor.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/checkout.min.css')}}">
@endsection
@section('content')
<div class="content">
    <section class="bread-crumb">
        <div class="container">
           <div class="row">
              <div class="col-12 a-left">
                 <ul class="breadcrumb">
                    <li class="home">
                       <a href="/"><span>Trang chủ</span></a>						
                       <span class="mr_lr">&nbsp;/&nbsp;</span>
                    </li>
                    <li><strong><span>Thanh toán đơn hàng</span></strong></li>
                 </ul>
              </div>
           </div>
        </div>
     </section>
    <form id="checkoutForm" method="post" action="{{route('postBill')}}">
        @csrf
        <div class="wrap">
            <main class="main">
                <div class="main__content">
                    <article class="animate-floating-labels row">
                        <div class="col col--two">
                            <section class="section">
                                <div class="section__header">
                                    <div class="layout-flex">
                                        <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                            <i
                                                class="fa fa-id-card-o fa-lg section__title--icon hide-on-desktop"></i>
                                            Thông tin nhận hàng
                                        </h2>
                                    </div>
                                </div>
                                <div class="section__content">
                                    <div class="fieldset">
                                        <div class="field "
                                            data-bind-class="{'field--show-floating-label': billing.name}">
                                            <div class="field__input-wrapper">
                                                <input name="billingName" id="billingName" type="text"
                                                    class="field__input" placeholder="Họ và tên"
                                                    value="{{$profile ? $profile->name : ""}}" required>
                                            </div>
                                        </div><br>
                                        <div class="field " data-bind-class="{'field--show-floating-label': email}">
                                            <div class="field__input-wrapper">
                                                <input name="billingEmail" id="email" type="Email"
                                                    class="field__input" placeholder="Email"
                                                    value="{{$profile ? $profile->email : ""}}">
                                            </div>
                                        </div><br>
                                        
                                        <div class="field "
                                            data-bind-class="{'field--show-floating-label': billing.phone}">
                                            <div class="field__input-wrapper">
                                                <input name="billingPhone" id="billingPhone" type="tel"
                                                    class="field__input" pattern="\d+" placeholder="Số điện thoại (tùy chọn)"
                                                    value="{{$profile ? $profile->phone : ""}}" required>
                                            </div>
                                        </div><br>
                                        <div class="field "
                                            data-bind-class="{'field--show-floating-label': billing.address}">
                                            <div class="field__input-wrapper">
                                                <input name="billingAddress" id="billingAddress" type="text"
                                                    class="field__input" placeholder="Địa chỉ nhận hàng" value=""
                                                    required>
                                            </div>
                                        </div><br><br>
                                    </div>
                                </div>
                            </section>
                            <div class="fieldset">
                                <h3 class="visually-hidden">Ghi chú</h3>
                                <div class="field " data-bind-class="{'field--show-floating-label': note}">
                                    <div class="field__input-wrapper">
                                        <textarea name="note" id="note" type="text" class="field__input"
                                            placeholder=" Ghi chú (tùy chọn)"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col col--two">
                            <section class="section">
                                <div class="section__header">
                                    <div class="layout-flex">
                                        <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                            <i class="fa fa-truck fa-lg section__title--icon hide-on-desktop"></i>
                                            Vận chuyển
                                        </h2>
                                    </div>
                                </div>
                                <div class="section__content" id="shippingMethodList">
                                    <div class="content-box" >
                                         <div class="content-box__row">
                                            <p>Quy định về thời gian giao hàng:</p>
                                            <p>Tại Hà Nội: Đơn hàng được giao qua Grab hoặc Ahahome với bán kính =< 6km</p>
                                            <p>Với các quận xa Hà Nội, và các tỉnh thành khác: Đơn hàng được giao qua các đơn vị chuyển phát nhanh</p>
                                            <p>Quý khách cần hỗ trợ xin liên hệ:</p>
                                            <ul>
                                                <li>Điện thoại: {{$setting->phone1}}</li>
                                                <li>Địa chỉ: {{$setting->address2}}</li>
                                                <li>Email: {{$setting->email}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </article>
                    <div class="field__input-btn-wrapper field__input-btn-wrapper--vertical hide-on-desktop">
                        <button type="submit" class="btn btn-checkout spinner">
                            <span class="spinner-label">ĐẶT HÀNG</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                <use href="#spinner"></use>
                            </svg>
                        </button>
                        <a href="/" class="previous-link">
                            <i class="previous-link__arrow">❮</i>
                            <span class="previous-link__content">Tiếp tục mua sắm</span>
                        </a>
                    </div>
                </div>
            </main>
            <aside class="sidebar">
                @php $total = 0; $qty = 0 ; @endphp
                @foreach((array) session('cart') as $id => $details)
                @php
                $total += ($details['price'] - ($details['price']*($details['discount']/100))) *
                $details['quantity'] ;
                $qty += $details['quantity'] ;
                @endphp
                @endforeach
                <input type="text" name="total_money" value="{{$total+28000}}" hidden>
                <div class="sidebar__header">
                    <h2 class="sidebar__title">
                        Đơn hàng ({{$qty}} sản phẩm)
                    </h2>
                </div>
                <div class="sidebar__content">
                    <div id="order-summary" class="order-summary order-summary--is-collapsed">
                        <div class="order-summary__sections">
                            <div
                                class="order-summary__section order-summary__section--product-list order-summary__section--is-scrollable order-summary--collapse-element">
                                <table class="product-table">
                                    <caption class="visually-hidden">Chi tiết đơn hàng</caption>
                                    <thead class="product-table__header">
                                        <tr>
                                            <th>
                                                <span class="visually-hidden">Ảnh sản phẩm</span>
                                            </th>
                                            <th>
                                                <span class="visually-hidden">Mô tả</span>
                                            </th>
                                            <th>
                                                <span class="visually-hidden">Sổ lượng</span>
                                            </th>
                                            <th>
                                                <span class="visually-hidden">Đơn giá</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach(session('cart') as $id => $details)
                                        <tr class="product">
                                            <td class="product__image">
                                                <div class="product-thumbnail">
                                                    <div class="product-thumbnail__wrapper" data-tg-static>
                                                        <img src="{{ url(''.$details['image']) }}" alt=""
                                                            class="product-thumbnail__image">
                                                    </div>
                                                    <span
                                                        class="product-thumbnail__quantity">{{ $details['quantity'] }}</span>
                                                </div>
                                            </td>
                                            <th class="product__description">
                                                <span class="product__description__name">
                                                    {{ languageName($details['name']) }}
                                                </span>
                                            </th>
                                            <td class="product__quantity visually-hidden"><em>Số lượng:</em>
                                                {{ $details['quantity'] }}</td>
                                            <td class="product__price">
                                                {{ number_format($details['price'] - ($details['price']*($details['discount']/100))) }}₫
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="order-summary__section order-summary__section--total-lines order-summary--collapse-element"
                                data-define="{subTotalPriceText: '{{number_format($total)}}₫'}"
                                data-tg-refresh="refreshOrderTotalPrice" id="orderSummary">
                                <table class="total-line-table">
                                    <caption class="visually-hidden">Tổng giá trị</caption>
                                    <thead>
                                        <tr>
                                            <td><span class="visually-hidden">Mô tả</span></td>
                                            <td><span class="visually-hidden">Giá tiền</span></td>
                                        </tr>
                                    </thead>
                                    <tbody class="total-line-table__tbody">
                                        <tr class="total-line total-line--subtotal">
                                            <th class="total-line__name">
                                                Tạm tính
                                            </th>
                                            <td class="total-line__price">{{number_format($total)}}₫</td>
                                        </tr>
                                        <tr class="total-line total-line--shipping-fee">
                                            <th class="total-line__name">
                                                Phí vận chuyển
                                            </th>
                                        </tr>
                                    </tbody>
                                    <tfoot class="total-line-table__footer">
                                        <tr class="total-line payment-due">
                                            <th class="total-line__name">
                                                <span class="payment-due__label-total">
                                                    Tổng cộng
                                                </span>
                                            </th>
                                            <td class="total-line__price">
                                                <span class="payment-due__price" >{{number_format($total)}}₫</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div
                                class="order-summary__nav field__input-btn-wrapper hide-on-mobile layout-flex--row-reverse">
                                <button type="submit" class="btn btn-checkout spinner"
                                    data-bind-class="{'spinner--active': isSubmitingCheckout}"
                                    data-bind-disabled="isSubmitingCheckout || isLoadingReductionCode">
                                    <span class="spinner-label">ĐẶT HÀNG</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="spinner-loader">
                                        <use href="#spinner"></use>
                                    </svg>
                                </button>
                                <a href="/" class="previous-link">
                                    <i class="previous-link__arrow">❮</i>
                                    <span class="previous-link__content">Tiếp tục mua sắm</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </form>
</div>

@endsection