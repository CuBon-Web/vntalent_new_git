@extends('layouts.main.master')
@section('title')
Giỏ hàng của bạn
@endsection
@section('description')
Bún đậu mắm tôm Lynh
@endsection
@section('image')
{{url(''.$banner[0]->image)}}
@endsection
@section('css')
<link href="{{asset('frontend/css/ajaxcart.scss.css?1663035745304')}}" rel="stylesheet" type="text/css" />
<link rel="preload" as='style' type="text/css" href="{{asset('frontend/css/ajaxcart.scss.css?1663035745304')}}">
@endsection
@section('content')
<div class="main-index">
    <section class="bread-crumb">
       <div class="container">
          <div class="row">
             <div class="col-12 a-left">
                <ul class="breadcrumb">
                   <li class="home">
                      <a href="/"><span>Trang chủ</span></a>						
                      <span class="mr_lr">&nbsp;/&nbsp;</span>
                   </li>
                   <li><strong><span>Giỏ hàng</span></strong></li>
                </ul>
             </div>
          </div>
       </div>
    </section>
    <section class="main-cart-page main-container col1-layout">
       <div class="main container cartpcstyle">
          <div class="wrap_background_aside margin-bottom-40">
             <div class="header-cart">
                <div class="title-block-page">
                   <h1 class="title_cart">
                      <span>Giỏ hàng của bạn</span>
                   </h1>
                </div>
             </div>
             <div class="row">
                <div class="col-xl-12 col-lg-12 col-12 order-lg-1 order-2 colleftcart">
                   <div class="cart-page d-xl-block d-none">
                      <div class="drawer__inner">
                         <div class="CartPageContainer">
                            @php $total = 0; $qty = 0 ; @endphp
                                @foreach((array) session('cart') as $id => $details)
                                            @php 
                                            $total += ($details['price'] - ($details['price']*($details['discount']/100))) * $details['quantity'] ;
                                            $qty += $details['quantity'] ;
                                            @endphp
                                @endforeach
                            <form action="" method="post" novalidate="" class="cart ajaxcart cartpage">
                               <div class="cart-header-info">
                                  <div>Thông tin sản phẩm</div>
                                  <div>Đơn giá</div>
                                  <div>Số lượng</div>
                                  <div>Thành tiền</div>
                               </div>
                               <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body items ">
                                @foreach ($cart as $id => $details)
                                  <div class="ajaxcart__row">
                                     <div class="ajaxcart__product cart_product" data-line="1">
                                        <a href="javascript:;" class="ajaxcart__product-image cart_image" title="{{ languageName($details['name']) }}"><img src="{{ url(''.$details['image']) }}" alt="{{ languageName($details['name']) }}"></a>
                                        <div class="grid__item cart_info">
                                           <div class="ajaxcart__product-name-wrapper cart_name">
                                              <a href="javascript:;" class="ajaxcart__product-name h4" title="{{ languageName($details['name']) }}">{{ languageName($details['name']) }}</a>
                                              <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:;" onclick="removeCart({{$details['idpro']}})" data-line="1">Xóa</a>
                                           </div>
                                           <div class="grid">
                                              <div class="grid__item one-half text-right cart_prices">
                                                 <span class="cart-price">{{ number_format($details['price'] - ($details['price']*($details['discount']/100))) }}₫</span>
                                              </div>
                                           </div>
                                           <div class="grid">
                                              <div class="grid__item one-half cart_select">
                                                 <div class="ajaxcart__qty input-group-btn">
                                                    <button type="button" class="ajaxcart__qty-adjust  items-count qtybutton" onclick="qtyminus({{$details['idpro']}})">
                                                    -
                                                    </button>
                                                    <input type="text" name="qtybutton" class=" number-sidebar"  value="{{$details['quantity']}}" id="quantity-{{$details['idpro']}}"   pattern="[0-9]*">
                                                    <button type="button" class="ajaxcart__qty-adjust  items-count qtybutton" onclick="qtyplus({{$details['idpro']}})">
                                                    +							
                                                    </button>
                                                 </div>
                                              </div>
                                           </div>
                                           <div class="grid">
                                              <div class="grid__item one-half text-right cart_prices">
                                                 <span class="cart-price" id="cartprice-{{$id}}">{{ number_format(($details['price'] - ($details['price']*($details['discount']/100)))*$details['quantity']) }}đ</span>
                                              </div>
                                           </div>
                                        </div>
                                     </div>
                                  </div>
                                @endforeach
                               </div>
                               <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                                  <div class="row">
                                     <div class="col-lg-4 col-12 offset-md-8 offset-lg-8 offset-xl-8">
                                        <div class="ajaxcart__subtotal">
                                           <div class="cart__subtotal">
                                              <div class="cart__col-6">Tổng tiền:</div>
                                              <div class="text-right cart__totle"><span class="total-price">{{number_format($total)}}₫</span></div>
                                           </div>
                                        </div>
                                        <div class="cart__btn-proceed-checkout-dt">
                                           <button type="button" onclick="location.href='/thanh-toan.html'" class="button btn btn-default cart__btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                                        </div>
                                     </div>
                                  </div>
                               </div>
                            </form>
                         </div>
                      </div>
                   </div>
                   <div class="cart-mobile-page d-block d-xl-none">
                    <div class="CartMobileContainer">
                       <form action="" method="post" novalidate="" class="cart ajaxcart cart-mobile">
                          <div class="ajaxcart__inner ajaxcart__inner--has-fixed-footer cart_body">
                            @foreach ($cart as $id => $details)
                             <div class="ajaxcart__row">
                                <div class="ajaxcart__product cart_product" data-line="1">
                                   <a href="javascript:;" class="ajaxcart__product-image cart_image" title="{{ languageName($details['name']) }}"><img width="80" height="80" src="//bizweb.dktcdn.net/thumb/compact/100/450/748/products/1e3d835ea10de65b5c81261f85130716-jpeg.jpg" alt="{{ languageName($details['name']) }}"></a>
                                   <div class="grid__item cart_info">
                                      <div class="ajaxcart__product-name-wrapper cart_name">
                                         <a href="javascript:;" class="ajaxcart__product-name h4" title="{{ languageName($details['name']) }}">{{ languageName($details['name']) }}</a>
                                      </div>
                                      <div class="grid">
                                         <div class="grid__item one-half cart_select cart_item_name">
                                            <div class="ajaxcart__qty input-group-btn">
                                               <button type="button" class="ajaxcart__qty-adjust items-count" onclick="qtyminus({{$details['idpro']}})">
                                               -
                                               </button>
                                               <input type="text" name="updates[]" class="ajaxcart__qty-num number-sidebar" value="{{$details['quantity']}}" id="quantity-{{$details['idpro']}}" pattern="[0-9]*">
                                               <button type="button" class="ajaxcart__qty-adjust items-count" onclick="qtyplus({{$details['idpro']}})">
                                               +							
                                               </button>
                                            </div>
                                         </div>
                                         <div class="grid__item one-half text-right cart_prices">
                                            <span class="cart-price" id="cartprice-{{$id}}">{{ number_format(($details['price'] - ($details['price']*($details['discount']/100)))*$details['quantity']) }}đ</span>
                                            <a class="cart__btn-remove remove-item-cart ajaxifyCart--remove" href="javascript:;" data-line="1">Xóa</a>
                                         </div>
                                      </div>
                                   </div>
                                </div>
                             </div>
                             @endforeach
                          </div>
                          <div class="ajaxcart__footer ajaxcart__footer--fixed cart-footer">
                             <div class="ajaxcart__subtotal">
                                <div class="cart__subtotal">
                                   <div class="cart__col-6">Tổng tiền:</div>
                                   <div class="text-right cart__totle"><span class="total-price">>{{number_format($total)}}₫</span></div>
                                </div>
                             </div>
                             <div class="cart__btn-proceed-checkout-dt">
                                <button onclick="location.href='/thanh-toan.html'" type="button" class="button btn btn-default cart__btn-proceed-checkout" title="Thanh toán">Thanh toán</button>
                             </div>
                          </div>
                       </form>
                    </div>
                 </div>
                   <div class="cart-mobile-page d-block d-xl-none">
                      <div class="CartMobileContainer"></div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
 </div>
@endsection