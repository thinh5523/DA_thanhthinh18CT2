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
              <h5 style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">THANH TOÁN</h5>
              {{-- <p style="margin-left: 35px; margin-top: 10px; ">làm ơn đăng nhập hoặc đk để thực hiện thanh toán</p> --}}
              <div class="check-out" >
              	<div class="form-checkout">
              		<i class="fas fa-pen-square"></i><p style="font-size: 22px;"> Điền thông tin gửi hàng</p>
              		<div class="form-one">
              			<form class="form-two" action="{{ URL::to('/save-checkout-customer') }}" method="POST">
              				{{ csrf_field() }}
              				<input class="three" type="text" name="shipping_email" placeholder=" Email" required>
              				<input class="three" type="text" name="shipping_name" placeholder=" Họ và tên" required>
              				<input class="three" type="text" name="shipping_address" placeholder=" Địa chỉ" required>
              				<input class="three" type="text" name="shipping_phone" placeholder=" Phone" required>
              				<textarea class="ghichu" name="shipping_notes" placeholder=" Ghi chú đơn hàng của bạn" rows="16" required></textarea>
                      {{-- <button class="xacnhan" type="submit" value="Xác nhận" name="send_order">Xác nhận</button> --}}
              				<input class="xacnhan" type="submit" value="Xác nhận đơn hàng" name="send_order">
              			</form>
              		</div>

              	</div>
                <div class="review-cart">

                	{{-- <a href="{{ URL::to('/gio-hang') }}"><p class="xemgiohang" style="margin-top: 10px;">Xem lại giỏ hàng</p></a> --}}
                </div>

            </div>
            <div>
            <form class="form-horizontal bucket-form" method="get">
                    @csrf
                    <div class="form-group">

                        <div class="col-lg-8" style="margin-left: 200px;">
                        <label style="margin-left: -55px;" class="col-sm-3 control-label col-lg-3" for="inputSuccess">Chọn thành phố</label>
                            <select name="city" class="form-control m-bot15 choose city" id="city" style="margin-bottom: 30px;margin-left: -40px; ">
                                <option value="" required>--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                            @endforeach
                            </select>
                            <label style="margin-left: -55px;" class="col-sm-3 control-label col-lg-3  " for="inputSuccess">Chọn Quậnhuyện</label>
                            <select class="form-control m-bot15 province choose" name="province" id="province" style="margin-bottom: 30px;margin-left: -40px;">
                                <option value="">--Chọn quận huyện--</option>
                            @foreach($province as $key => $provinces)
                                <option value="{{$provinces->maqh}}">{{$provinces->name_quanhuyen}}</option>
                            @endforeach
                            </select>
                            <label style="margin-left: -55px;" class="col-sm-3 control-label col-lg-3 " for="inputSuccess">Chọn xã/phường</label>
                            <select class="form-control m-bot15 wards" name="wards" id="wards" style="margin-bottom: 30px;margin-left: -40px;">
                                <option value="">--Chọn xã phường--</option>
                            @foreach($wards as $key => $wa)
                                <option value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
                            @endforeach
                            </select>
                    </div>
                    <input class="calculate_ship" style="margin-top: 30px; margin-left: 160px;" type="button" value="Tính phí vận chuyển" name="calculate_order">
                </form>
                {{-- <?php
                echo Session::get('fee');
                ?> --}}
                </div>

            <div class="content1" style="margin-left: 0px;margin-top: -130px;">
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

                    @if(Session::get('fee'))

                    <p class="tt-cart-8"><a href="{{ url('/delete-fee') }}"><i class="fas fa-times-circle"></i></a> {{ number_format(Session::get('fee'),0,',','.').'Vnđ' }}</p>
                      {{-- <?php
                    $total_after_fee = $total+=Session::get('fee');
                    ?> --}}
                    @endif
                  </div>
                  <div class="tt-4">
                    <p class="tt-cart-4">Thành tiền</p>
                    @php
                      if(Session::get('fee')){
                        $total_after_fee = $total+=Session::get('fee');
                      }elseif(!Session::get('fee')){
                        $total_after_fee = $total;
                      }

                    @endphp



                    <p class="tt-cart-9">{{ number_format($total_after_fee,0,',','.') }}Vnđ</p>

                  </div>

                </div>
                <div class="btn-cart">
                  {{-- <a href="" type="btn-update" name="btn-update" class="btn-update" style="margin-top: 50px;">Cập nhật</a> --}}

                  </div>
                  {{-- @if(Session::get('fee'))
                  <li>Phí vận chuyển <span>{{ number_format(Session::get('fee'),0,',','.').'Vnđ' }}</span></li>
                  @endif --}}
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

        </div>


        </div> <!-- kết thúc nội dung chính -->
        </div>
@endsection
