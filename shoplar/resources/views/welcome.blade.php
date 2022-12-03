<!DOCTYPE html>
<html>
<head>
  <title>Home Petshop</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="{{asset('fontend/css/home.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('fontend/css/search.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('fontend/css/sweetalert.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
    $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).var();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-ship-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('.calculate_ship').click(function(){
        var matp = $('.city').val();
        var maqh = $('.province').val();
        var xaid = $('.wards').val();
        var _token = $('input[name="_token"]').val();
        if(matp == '' && maqh == '' && xaid == ''){
          alert('Yêu cầu chọn để tính phí vận chuyển');
        }else{


        $.ajax({
                url : '{{url('/calculate-fee')}}',
                method: 'POST',
                data:{matp:matp,maqh:maqh,_token:_token,xaid:xaid},
                success:function(){
                    location.reload();
                }

            });
        }
      });

    });
  </script>
  {{-- cmt --}}
  <script type="text/javascript">
    $(document).ready(function(){
      // alert(product_id)
      load_comment();
      function load_comment(){
        var product_id = $('.comment_product_id').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url:"{{url('/load-comment')}}",
          method:"POST",
          data:{product_id:product_id, _token:_token},
          success:function(data){

            $('#comment_show').html(data);
          }
        });
      }
      $('.send-comment').click(function(){
        var product_id = $('.comment_product_id').val();
        var comment_name = $('.comment_name').val();
        var comment_content = $('.comment_content').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
          url:"{{url('/send-comment')}}",
          method:"POST",
          data:{product_id:product_id,comment_name:comment_name,comment_content:comment_content, _token:_token},
          success:function(data){

            $('#notify_comment').html('<span class="tbl">Thêm bình luận thành công</span>');
            load_comment();
            $('#notify_comment').fadeOut(3000);
            $('.comment_name').val('');
            $('.comment_content').val('');
          }
        });

      });

     });
  </script>
  {{-- jsquery cart-ajax --}}
  <script type="text/javascript">
    function remove_background(product_id)
    {
      for(var count = 1; count <= 5; count++)
      {
      $('#'+product_id+'-'+count).css('color', '#ccc');
      }
    }
    //  hover chuot danh gia sao
    $(document).on('mouseenter', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data("product_id");
      // alert(index);
      // alert(product_id);
      remove_background(product_id);

      for(var count = 1; count <= index; count++)
      {
      $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }

    });
    //  nha chuot khong danh gia
    $(document).on('mouseleave', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data("product_id");
      var rating = $(this).data("rating");
      remove_background(product_id);

      for(var count = 1; count <= rating; count++)
      {
      $('#'+product_id+'-'+count).css('color', '#ffcc00');
      }
    });
    // CLICK danh gia sao
    $(document).on('click', '.rating', function(){
      var index = $(this).data("index");
      var product_id = $(this).data("product_id");
      var _token = $('input[name="_token"]').val();

      $.ajax({
              url: '{{url('/insert-rating')}}',
              method: 'POST',
              data:{index:index,product_id:product_id,_token:_token},
              success:function(data)
              {
              if(data == 'done')
              {
                alert("Bạn đã đánh giá "+index +" trên 5");
              }
              else
              {
                alert("Lỗi đánh giá");
              }
              }
            });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
        $('.add-to-cart').click(function(){
          var id= $(this).data('id_product');
          var cart_product_id = $('.cart_product_id_' + id).val();
          var cart_product_name = $('.cart_product_name_' + id).val();
          var cart_product_image = $('.cart_product_image_' + id).val();
          var cart_product_price = $('.cart_product_price_' + id).val();
          var cart_product_qty = $('.cart_product_qty_' + id).val();
          var _token = $('input[name="_token"]').val();

          $.ajax({
              url: '{{url('/add-cart-ajax')}}',
              method: 'POST',
              data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token},
              success:function(data){
                    swal({
                              title: "Đã thêm sản phẩm vào giỏ hàng",
                              text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                              showCancelButton: true,
                              cancelButtonText: "Xem tiếp",
                              confirmButtonClass: "btn-success",
                              confirmButtonText: "Đi đến giỏ hàng",
                              closeOnConfirm: false
                            },
                            function() {
                              window.location.href = "{{url('/gio-hang')}}";
                            });

                }
          });
        });
    });
</script>
</head>
<body>
  <div class="wrap">
    <header>
        <div class="logo">
          <a href="{{URL::to('/trang-chu')}}" style="color: white; text-decoration: none;"><img class="size-logo" src="{{ URL::to('/fontend/img/looogo.png') }}"></a>
        </div>
            <ul class="menu">
              <li class="menu-1"><a  href="{{URL::to('/trang-chu')}}">TRANG CHỦ</a></li>
              <li class="menu-1"><a href="{{ URL::to('/all-pet') }}">THÚ CƯNG</a>
                <ul >
                  @foreach($category as $key => $cate)
                  <li><a href="{{ URL::to('/danh-muc-san-pham/'.$cate->category_id) }}">{{ $cate->category_name }}</a></li>
                  @endforeach
                  <li><a href="{{ URL::to('/all-pet') }}">Tất cả</a></li>
                </ul>
              </li>
              <li class="menu-1"><a href="{{ URL::to('/danh-muc-san-pham/16') }}">PHỤ KIỆN</a>
                <ul>
                  <li><a href="{{ URL::to('/danh-muc-san-pham/16') }}">NHÀ PET</a></li>
                  <li><a href="">PHỤ KIỆN MÈO</a></li>
                  <li><a href="">PHỤ KIỆN CHÓ</a></li>
                  <li><a href="{{ URL::to('/danh-muc-san-pham/18') }}">ĐỒ CHƠI PET</a></li>
                  <li><a href="{{ URL::to('/danh-muc-san-pham/17') }}">THỨC ĂN</a></li>
                </ul>
              </li>
              <li class="menu-1"><a href="{{ URL::to('gio-hang') }}">GIỎ HÀNG</a></li>
              <li class="menu-1"><a href="https://www.facebook.com/matpetfamily">LIÊN HỆ</a></li>
              <li class="menu-1" style="margin-left: -10px;"><a href="">GIỚI THIỆU</a></li>
            </ul>
            <div class="taikhoan">
              <?php
                $customers_id = Session::get('customers_id');
                if($customers_id!=NULL){

              ?>
              <i class="fas fa-sign-out-alt"></i><a style="text-decoration: none;color: white;" class="taikhoan1" href="{{ URL::to('/logout-checkout') }}"> ĐĂNG XUẤT</a>

              <?php
        }else{
              ?>
              <i class="fas fa-sign-in-alt"></i></i><a style="text-decoration: none;color: white;" class="taikhoan1" href="{{ URL::to('/login-checkout') }}"> ĐĂNG NHẬP</a>
              <?php
            }
              ?>

            </div>
  </header>
    <div class="main"  > <!-- bao phần nội dung chính -->

      @yield('content')

        </div> <!-- kết thúc nội dung chính -->

        <div class="footer"> <!-- phần header -->
          <div>
            <div class="petshop">
                <h4>PETSHOP</h4>
                <p class="ndpetshop">Pet Shop là nhãn hiệu của các sản phẩm may mặc thiết kế và sản xuất gồm các mặt hàng thời trang (quần, áo, váy,…), túi xách, ba-lô, bóp ví, phụ kiện các loại, các mặt hàng phòng ngủ, phòng bếp và rất nhiều sản phẩm khác,...</p>
            </div>
            <div class="petshop">
                <h4>LIÊN HỆ</h4>
                <p class="ndpetshop"><i class="fas fa-map-marker-alt" style="font-size: 15px;"></i>    50 An Trung5, Sơn Trà, Đà Nẵng.</p>
                <p class="ndpetshop"><i class="fas fa-phone" style="font-size: 15px;"></i> 0384.428.572</p>
                <p class="ndpetshop"><i class="fas fa-envelope" style="font-size: 15px;"></i> ntt5523@gmail.com</p>
            </div>
            <div class="petshop">
                <h4>MẠNG XÃ HỘI</h4>
                <p class="ndpetshop"><i class="fab fa-facebook"></i> Facebook </p>
                <p class="ndpetshop"><i class="fab fa-youtube"></i> Youtobe </p>
                <p class="ndpetshop"><i class="fab fa-instagram"></i> Instagram</p>

            </div>
            <div class="petshop">
                <h4>HỖ TRỢ</h4>
                <p class="ndpetshop">Liên hệ hỗ trợ</p>
                <p class="ndpetshop">Chính sách đổi trả</p>
                <p class="ndpetshop">Hướng dẫn mua hàng</p>
                <p class="ndpetshop">Chiến lược kinh doanh</p>
            </div>
            </div>
        </div>



</body>

<script type="text/javascript" src="{{asset('fontend/js/slidee.js')}}"></script>
<script src="{{asset('fontend/js/sweetalert1.js')}}"></script>
<script>
      const searchBox = document.querySelector(".search-box");
      const searchBtn = document.querySelector(".search-icon");
      const cancelBtn = document.querySelector(".cancel-icon");
      const searchInput = document.querySelector("input");
      const searchData = document.querySelector(".search-data");
      searchBtn.onclick =()=>{
        searchBox.classList.add("active");
        searchBtn.classList.add("active");
        searchInput.classList.add("active");
        cancelBtn.classList.add("active");
        searchInput.focus();
        if(searchInput.value != ""){
          var values = searchInput.value;
          searchData.classList.remove("active");
          searchData.innerHTML = "Bạn vừa gõ " + "<span style='font-weight: 500;'>" + values + "</span>";
        }else{
          searchData.textContent = "";
        }
      }
      cancelBtn.onclick =()=>{
        searchBox.classList.remove("active");
        searchBtn.classList.remove("active");
        searchInput.classList.remove("active");
        cancelBtn.classList.remove("active");
        searchData.classList.toggle("active");
        searchInput.value = "";
      }
    </script>
<script>
         const loginText = document.querySelector(".title-text .login");
         const loginForm = document.querySelector("form.login");
         const loginBtn = document.querySelector("label.login");
         const signupBtn = document.querySelector("label.signup");
         const signupLink = document.querySelector("form .signup-link a");
         signupBtn.onclick = (()=>{
           loginForm.style.marginLeft = "-50%";
           loginText.style.marginLeft = "-50%";
         });
         loginBtn.onclick = (()=>{
           loginForm.style.marginLeft = "0%";
           loginText.style.marginLeft = "0%";
         });
         signupLink.onclick = (()=>{
           signupBtn.click();
           return false;
         });
      </script>
<script type="text/javascript">
        var colorsList = document.querySelectorAll(".product>.colors>img");
        for (var i = 0; i < colorsList.length; i++) {
            colorsList[i].onmouseover = function(){
                var mainImg = document.querySelector(".product>.mainpicture");
                mainImg.src = this.src;
            }
        }
    </script>
</html>
