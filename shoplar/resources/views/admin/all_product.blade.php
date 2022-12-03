@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê sản phẩm
    </div>
    <?php
            $message = Session::get('message');
            if($message){
            echo '<span class="text-alert">',$message.'</span>';
            Session::put('message',null);
            }
        ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th style="width:20px;">
              <label class="i-checks m-b-none">

              </label>
            </th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Hình sản phẩm</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>

            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_product as $key => $pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $pro->product_name }}</td>
            <td>{{ number_format($pro->product_price,0,',','.').'đ'}}</td>
            <td><img src="uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
            <td>{{ $pro->category_name }}</td>
            <td>{{ $pro->brand_name }}</td>

            <td><span class="text-ellipsis">
                <?php
                if($pro->product_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><i class="fas fa-eye-slash" style="font-size: 20px; margin-left: 10px;"></i></a>';
                <?php
                }else{
                ?>
                <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><i class="fas fa-eye" style="font-size: 20px;margin-left: 10px;"></i></a>';
                <?php
                }
                ?>
            </span></td>

            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Xác nhận xóa sản phẩm?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>

      </table>

    </div>
    {{ $all_product->links('pagination::bootstrap-4') }}
    <footer class="panel-footer">
      <div class="row">

        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>

      </div>
    </footer>
  </div>
</div>
        @endsection
