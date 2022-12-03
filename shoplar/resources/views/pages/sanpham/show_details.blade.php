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
                @foreach($product_details as $key => $value)
                <div class="allpet">

                <div class="pet1">
                    <div class="product">
                        <img  src="{{URL::to('/uploads/product/'.$value->product_image)}}" class="mainpicture">

                    </div>

                    <div class="thongtinpet">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$value->product_id}}" class="cart_product_id_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_name}}" class="cart_product_name_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_image}}" class="cart_product_image_{{$value->product_id}}">
                        <input type="hidden" value="{{$value->product_price}}" class="cart_product_price_{{$value->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$value->product_id}}">
                    <p class="tenpet1">{{ $value->product_name }}</p>
                    <p class="mdh">ID: {{ $value->product_id }}</p>
                    <div class="themgh">
                        <p class="gia">Giá: {{ number_format($value->product_price).'VNĐ' }}</p>


                    </div>
                    <p class="tt">Tình trạng: Còn hàng</p>
                    <p class="dm">Thương hiệu: {{ $value->brand_name }}</p>
                    <p class="dm">Danh mục: {{ $value->category_name }}</p>
                    <div class="cart">
                        <button type="button" name="add-to-cart" data-id_product="{{ $value->product_id }}" class="add-to-cart" style="height:50px; width: 160px;font-size: 16px; margin-top: 10px; "><i class="fas fa-cart-plus" ></i> Thêm giỏ hàng</button>
                        {{-- <a href="" type="btn-submit1" name="btn-submit1" class="btn-submit1" ><i style="font-size: 20px; " class="fab fa-gratipay"></i></a> --}}
                        </div>
                    </form>
                    </div>

                    <div class="allcontent">
                        <div class="motasanpham">
                            <div class="motasanpham1">
                                <h2 class="noidungmt">MÔ TẢ SẢN PHẨM</h2>
                                <p class="noidungmt1">{!!$value->product_desc!!}</p>
                            </div>
                        </div>
                        <div class="chitietsanpham">
                            <div class="chitietsanpham1">
                                <h2 class="noidungct">CHI TIẾT SẢN PHẨM</h2>
                                <p class="noidungct1">{!!$value->product_content!!}</p>
                            </div>
                        </div>
                        <div class="comment">
                            <div class="danhgia">
                                <h2 class="danhgia1">ĐÁNH GIÁ</h2>
                            </div>
                            <div class="cmt-tt">
                                <ul>
                                    <li class="tt-cmt">Admin</li>
                                    <li class="tt-cmt">6:00am</li>
                                    <li class="tt-cmt">25/11/2022</li>
                                </ul>
                            </div>
                            <form method="POST">
                                @csrf
                                <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{ $value->product_id }}">
                                <div id="comment_show"></div>

                            </form>
                            <h5 class="name-cmt">Viết đánh giá của bạn</h5>
                            <h5 class="name-cmt">Đánh giá sao:</h5>
                            <ul class="" style="margin-top: -43px; margin-left: 150px;">
                                @for($count=1; $count<=5; $count++)

                                    @php
                                        if($count<=$rating){
                                            $color = 'color:#ffcc00;';
                                        }
                                        else{
                                            $color = 'color:#ccc;';
                                        }

                                    @endphp
                                <li title="Đánh giá sao"
                                id="{{ $value->product_id }}-{{ $count }}"
                                data-index="{{ $count }}"
                                data-product_id="{{ $value->product_id }}"
                                data-rating="{{ $rating }}"
                                class="rating"
                                style="font-size: 30px; {{ $color }} float: left;  cursor: pointer;"
                                >
                                    &#9733;
                                </li>
                                @endfor
                            </ul>
                            <h1></h1>
                            <form style="margin-top: 50px;" method="POST">
                                <span>
                                    <input class="comment_name" type="text" placeholder="Tên bình luận">
                                    {{-- <input class="comment_name" type="email" placeholder="Email address"> --}}
                                </span>
                                <textarea style="height: 150px;" class="comment_content" name="comment" placeholder="Nội dung bình luận "></textarea>
                                <h6 class=""></h6>
                                <button class="btn-comment send-comment" type="button">Gửi bình luận</button>
                                <div id="notify_comment"></div>
                            </form>
                        </div>
                    </div>

                    <div class="sp-tuongtu" max="4">
                        <h2>SẢN PHẨM TƯƠNG TỰ</h2>
                        @foreach($relate as $key => $lienquan)
                        <ul class="list-person">
                        <form>
                            @csrf
                        <input type="hidden" value="{{$lienquan->product_id}}" class="cart_product_id_{{$lienquan->product_id}}">
                        <input type="hidden" value="{{$lienquan->product_name}}" class="cart_product_name_{{$lienquan->product_id}}">
                        <input type="hidden" value="{{$lienquan->product_image}}" class="cart_product_image_{{$lienquan->product_id}}">
                        <input type="hidden" value="{{$lienquan->product_price}}" class="cart_product_price_{{$lienquan->product_id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$lienquan->product_id}}">
                        <li style="margin-left: -120px;float: left; ">
                            <a href="{{ URL::to('/chi-tiet-san-pham/'.$lienquan->product_id) }}">
                                <img src="{{ URL::to('uploads/product/'.$lienquan->product_image) }}">
                                <div class="name">Xem chi tiết</div>
                            </a>
                        </li>
                        <div class="chitietsp" style="margin-left: -120px;">
                        <p style="margin-bottom: 0px;">ID: {{ $lienquan->product_id }}</p>
                        <a href="{{ URL::to('/chi-tiet-san-pham/'.$lienquan->product_id) }}" class="tencun">{{ $lienquan->product_name }}</a>
                        <p>Giá: {{number_format($lienquan->product_price) }} Vnđ</p>
                        <div class="cart">
                        <button type="button" name="add-to-cart" data-id_product="{{ $lienquan->product_id }}" class="add-to-cart"><i class="fas fa-cart-plus"></i> Thêm giỏ hàng</button>
                        <a href="" type="btn-submit" name="add-to-cart" class="add-to-cart" ><i style="font-size: 15px; " class="fab fa-gratipay"></i></a>
                        </div>
                        </div>
                        </form>
                    </ul>
                    @endforeach
                    </div>

                </div>

            </div>
            @endforeach
            </div>


@endsection

