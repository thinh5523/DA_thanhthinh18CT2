@extends('welcome')
@section('content')
<div class="nav">
            </div>
	<div class="content">
                <div class="dmpet">
                <p class="dmpet1">DANH MỤC SẢN PHẨM</p>
                @foreach($category as $key => $cate)
                <p><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}" class="dmpet-2"style="text-decoration: none;">{{ $cate->category_name }}</a></p>
                @endforeach

                <p class="dmpet1">THƯƠNG HIỆU SẢN PHẨM</p>
                @foreach($brand as $key => $brand)
                <p><a href="{{ URL::to('/thuong-hieu-san-pham/'.$brand->brand_id) }}" class="dmpet-2"style="text-decoration: none;">{{ $brand->brand_name }}</a></p>
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
              <h5 style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">THANH TOÁN GIỎ HÀNG</h5>
              {{-- <div class="review-cart1">
                  <a href="{{ URL::to('/gio-hang') }}"><p class="cart-am">Xem lại giỏ hàng</p></a>
                </div> --}}
              <form action="{{ url('/update-cart') }}" method="POST">
                @csrf
              <div class="check-out-1" >
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
                    <p><a href="" style="color: black;">{{ $cart['product_name'] }}</a></p>
                    {{-- {{ $v_content->name }} --}}
                    <p class="id-cart">Id: {{ $cart['product_id'] }}</p>
                  </div>
                  <div class="cart-3">
                    <p >{{ number_format($cart['product_price'],0,',','.').'Vnđ' }}</p>
                    {{-- {{ number_format($v_content->price).''.'Vnđ' }} --}}
                  </div>
                  <div class="cart-4">

                    <input class="cart_quantity" name="cart_qty[{{ $cart['session_id'] }}]" type="number" max="10" min="1" value="{{ $cart['product_qty'] }}">
                  </div>

                  <div class="cart-5">
                    <p>{{ number_format($subtotal,0,',','.').'Vnđ' }}</p>
                  </div>
                  <div class="cart-6">
                    <a href="{{ url('/del-product/'.$cart['session_id']) }}"><i class="fas fa-trash-alt" style="color: black;"></i></i></a>
                  </div>
              </div>
              @endforeach
              <div >
                <input class="btn-update" type="submit" value="cập nhật" name="update_qty">
                <a href="{{ url('/del-all-product') }}" type="btn-update" name="btn-update" class="btn-update" style="text-decoration: none;">Xóa tất cả</a>
                <div style="margin-left: 30px;" class="tt-1">
                    <p class="tt-cart-1">Tổng(Bao gồm phí ship)</p>
                    <p class="tt-cart-6">{{ number_format($total+=Session::get('fee'),0,',','.').'Vnđ' }}</p>
                  </div>
                <div>

                </div>
              </div>
              @else
              <div style="text-align: center;">
                @php
                echo ' Làm ơn thêm vào giỏ hàng để tiến hành thanh toán';
                @endphp
              </div>
              @endif


            </div>
            </form>
            <h4 class="httt">Chọn hình thức thanh toán</h4>
            <form style="margin-left: 10px;" action="{{ URL::to('/order-place') }}" method="POST">
              {{ csrf_field() }}
                <div class="payment">
                  <span>
                    <label><input type="radio" value="1" name="payment_option"> Thanh toán bằng thẻ</label>
                  </span>
                  <br>
                  <span>
                    <label><input type="radio" value="2" name="payment_option"> Thanh toán bằng tiền mặt (Hỗ trợ)</label>
                  </span>
                  <br>
                  <span>
                    <label><input type="radio" value="3" name="payment_option"> Thanh toán bằng thẻ ghi nợ</label>
                  </span>
                  <br>
                  <input class="xacnhan-1" type="submit" value="Đặt hàng" name="send_order_place" required>
                </div>
            </form>
            </div>


        </div> <!-- kết thúc nội dung chính -->

@endsection
