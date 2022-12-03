@extends('welcome')
@section('content')
<div class="slide">
                <div class="dieuhuong">
                    <i class="fas fa-chevron-circle-left"  onclick="Back();"></i>
                    <i class="fas fa-chevron-circle-right" onclick="Next();"></i>
                </div>
                <div class="chuyen-slide" >
                    <img src="{{'public\fontend\img\c1.jpg'}}">
                    <img src="{{'public\fontend\img\c22.jpg'}}">
                    <img src="{{'public\fontend\img\c33.jpg'}}">
                    <img src="{{'public\fontend\img\c.jpg'}}">
                    <img src="{{'public\fontend\img\pet111.jpg'}}">
                </div>
            </div>
            <div class="search">
                <form action="{{ URL::to('/tim-kiem') }}" method="POST">
                    {{ csrf_field() }}
                <div class="search-in">
                    <input class="search-in-1" type="text" name="keywords_submit" placeholder=" Tìm kiếm sản phẩm..">
                    <button type="submit" class="btn-search" style="height: 50px;" name="search_items"><i class="fas fa-search"></i></button>
                    {{-- <input type="submit" class="btn-search" style="height: 50px;" name="search_items" value="Tìm kiếm"> --}}
                </div>
                </form>
            </div>
            <div class="nav">
                <h4 style=" margin-left: 540px;">TRANG CHỦ | DANH MỤC SẢN PHẨM</h4>
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
                    <h5>KẾT QUẢ TÌM KIẾM</h5>
                    @foreach($search_product as $key => $product)
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
                        <p>Giá: {{number_format($product->product_price) }} Vnđ</p>
                        <div class="cart">
                        {{-- <a href="{{ URL::to('save-cart') }}" type="btn-submit" name="btn-submit" class="btn-submit"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</a> --}}
                        <button type="button" name="add-to-cart" data-id_product="{{ $product->product_id }}" class="add-to-cart"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</button>
                        <a href="" type="btn-submit" name="btn-submit" class="add-to-cart" ><i style="font-size: 15px; " class="fab fa-gratipay"></i></a>
                        </div>
                        </div>
                        </form>
                    </ul>
                    @endforeach
                      <div class="phantrangsearch" style="margin-left: -500px;">
                  {{ $search_product->links('pagination::bootstrap-4') }}
                </div>
                </div>


            </div>
            <div class="phuongthuc">
                <div class="uudiem">
                    <i class="fas fa-truck" style="font-size: 40px;margin-top: 30px;"></i>
                    <h4 class="name-uudiem1">Vận chuyển nhanh chóng</h4>
                    <p class="name-uudiem2">Miễn phí giao hàng trong nội thành Thành Phố Đà Nẵng.</p>
                </div>
                <div class="uudiem">
                    <i class="fas fa-info-circle" style="font-size: 40px;margin-top: 30px;"></i>
                    <h4 class="name-uudiem1">Hỗ trợ khách hàng</h4>
                    <p class="name-uudiem2">Hỗ trợ trực tuyến và qua đường dây nóng 24/7.</p>
                </div>
                <div class="uudiem">
                    <i class="fas fa-heart" style="font-size: 40px;margin-top: 30px;"></i>
                    <h4 class="name-uudiem1">Sản phẩm chất lượng</h4>
                    <p class="name-uudiem2">Sản phẩm có xuất xứ 100%, bảo hành 1năm đến 2 năm, cam kết chất lượng. </p>
                </div>
            </div>


@endsection
