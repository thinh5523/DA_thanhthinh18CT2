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
              <h5 style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">THANH TOÁN GIỎ HÀNG</h5>
              <div class="review-cart1">
                  
                </div>
              
            <p class="httt"> Cảm ơn bạn đã đặt hàng của shop chúng tôi, chúng tôi sẽ liên hệ với bạn sớm nhất...</p>
                    
            </div>
            
                   
        </div> <!-- kết thúc nội dung chính -->
        </div>
@endsection
