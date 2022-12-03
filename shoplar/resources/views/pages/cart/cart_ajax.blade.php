@extends('welcome')
@section('content')
<div class="nav">
            </div>
	<div class="content">
                <div class="dmpet">
                <p class="dmpet1">DANH MỤC SẢN PHẨM</p>
                @foreach($category as $key => $cate)
                <p><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}" class="dmpet-2" style="text-decoration: none;">{{ $cate->category_name }}</a></p>
                @endforeach

                <p class="dmpet1">THƯƠNG HIỆU SẢN PHẨM</p>
                @foreach($brand as $key => $brand)
                <p><a href="{{ URL::to('/thuong-hieu-san-pham/'.$brand->brand_id) }}" class="dmpet-2" style="text-decoration: none;">{{ $brand->brand_name }}</a></p>
                @endforeach
                </div>
            <div class="content1">
              @if(session()->has('message'))
                  <div class="delete-true">
                      {{ session()->get('message') }}
                  <i class="fas fa-check" style="color:#00CC00;"></i>
                  </div>
                @elseif(session()->has('message'))
                  <div class="delete-f" >
                      {{ session()->get('error') }}
                  </div>
              @endif
              <h5 style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">GIỎ HÀNG z</h5>
              <?php
              $content = Cart::content();
              ?>
              <form action="{{ url('/update-cart') }}" method="POST">
                @csrf
              <div class="cart-1-2" >
                <div class="namecart-1">
                <div class="namecart-11">
                  	<p>Ảnh sản phẩm</p>
                  </div>
                  <div class="namecart-2">
                  	<p>Tên sản phẩm</p>
                  </div>
                  <div class="namecart-3">
                    <p>Giá sản phẩm</p>
                  </div>
                  <div class="namecart-4">
                    <p>Số lượng</p>
                  </div>
                  <div class="namecart-5">
                    <p>Thành tiền</p>
                  </div>
              </div>
              {{-- @foreach($content as $v_content)@endforeach --}}
              @if(Session::get('cart')==true)
              @php
                $total = 0;
              @endphp
              @foreach(Session::get('cart') as $key => $cart)
                @php
                    $subtotal = $cart['product_price']*$cart['product_qty'];
                    $total+=$subtotal;
                @endphp
              <div class="cart-1">
                  <div class="cart-0">
                    <img width="90px" height="90px" src="{{ asset('uploads/product/'.$cart['product_image']) }}" alt="{{ $cart['product_name'] }}" />
                    {{-- {{ URL::to('uploads/product/'.$v_content->options->image) }} --}}
                  </div>
                  <div class="cart-2">
                    <p><a href="" >{{ $cart['product_name'] }}</a></p>
                    {{-- {{ $v_content->name }} --}}
                    <p class="id-cart">Id: {{ $cart['product_id'] }}</p>
                  </div>
                  <div class="cart-3">
                    <p >{{ number_format($cart['product_price'],0,',','.') }}Vnđ</p>
                    {{-- {{ number_format($v_content->price).''.'Vnđ' }} --}}
                  </div>
                  <div class="cart-4">

                    <input class="cart_quantity" name="cart_qty[{{ $cart['session_id'] }}]" type="number" max="10" min="1" value="{{ $cart['product_qty'] }}">
                  </div>

                  <div class="cart-5">
                    <p>{{ number_format($subtotal,0,',','.').'Vnđ' }}</p>
                  </div>
                  <div class="cart-6">
                    <a href="{{ url('/del-product/'.$cart['session_id']) }}"><i class="fas fa-trash-alt" style="color: black;"></i></a>
                  </div>
              </div>
              @endforeach
              <div >
                <input class="btn-update" type="submit" value="cập nhật" name="update_qty">
                <a href="{{ url('/del-all-product') }}" type="btn-update" name="btn-update" class="btn-update" style="text-decoration: none;">Xóa tất cả</a>

                <div>
                  <div class="tt-1">
                    <p class="tt-cart-1">Tổng</p>
                    <p class="tt-cart-6">{{ number_format($total,0,',','.').'Vnđ' }}</p>
                  </div>
                  <div class="tt-2">
                    <p class="tt-cart-2">Thuế</p>
                    <p class="tt-cart-7">0%</p>
                  </div>
                  <div class="tt-3">
                    <p class="tt-cart-3">Phí vận chuyển</p>
                    <p class="tt-cart-8"></p>
                  </div>
                  <div class="tt-4">
                    <p class="tt-cart-4">Thành tiền</p>
                    <p class="tt-cart-9">{{ number_format($total,0,',','.') }}Vnđ</p>
                  </div>

                </div>
                <div class="btn-cart">
                  {{-- <a href="" type="btn-update" name="btn-update" class="btn-update" style="margin-top: 50px;">Cập nhật</a> --}}
                  <?php
                    $customers_id = Session::get('customers_id');
                    if($customers_id!=NULL){

                  ?>
                      <a href="{{ URL::to('/checkout') }}" type="btn-update" name="btn-update" class="btn-update" style="text-decoration: none;">Thanh toán</a>
                  <?php
                }else{
                  ?>
                      <a href="{{ URL::to('/login-checkout') }}" type="btn-update" name="btn-update" class="btn-update" style="text-decoration: none;">Thanh toán</a>
                  <?php
                  }
                  ?>
                  </div>
              </div>
              @else
              <div style="text-align: center;">
                @php
                echo ' Làm ơn thêm vào giỏ hàng';
                @endphp
              </div>
              @endif


            </div>
            </form>
            {{-- <div class="thanhtoan">

            </div> --}}

        </div> <!-- kết thúc nội dung chính -->
        </div>
@endsection
