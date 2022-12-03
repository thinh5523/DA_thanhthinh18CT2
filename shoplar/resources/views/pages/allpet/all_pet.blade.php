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
              <h5 style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">TẤT CẢ PET</h5>
              <div class="all-pet" >
                @foreach($all_pet as $key => $product)
                    <ul class="list-person">
                        <form>
                            @csrf
                        <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                        <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                        <li style="margin-left: -100px;float: left;  ">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}">
                                <img src="{{ URL::to('uploads/product/'.$product->product_image) }}">
                                <div class="name">Xem chi tiết</div>
                            </a>
                        </li>
                        <div class="chitietsp">
                        <p style="margin-bottom: 0px;">ID: {{ $product->product_id }}</p>
                        <a href="{{ URL::to('/chi-tiet-san-pham/'.$product->product_id) }}" class="tencun">{{ $product->product_name }}</a>
                        <p>Giá: {{number_format($product->product_price).'Vnđ' }}</p>
                        <div class="cart">
                        {{-- <a href="{{ URL::to('save-cart') }}" type="btn-submit" name="btn-submit" class="btn-submit"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</a> --}}
                        <button type="button" name="add-to-cart" data-id_product="{{ $product->product_id }}" class="add-to-cart"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</button>
                        <a href="" type="btn-submit" name="btn-submit" class="add-to-cart" ><i style="font-size: 15px; " class="fab fa-gratipay"></i></a>
                        </div>
                        </div>
                        </form>
                    </ul>
                    @endforeach


              </div>
              <div class="pt-allpet">
                        {{ $all_pet->links('pagination::bootstrap-4') }}
                    </div>
            </div>

        </div>
@endsection
