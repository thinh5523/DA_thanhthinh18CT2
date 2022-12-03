@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục sản phẩm
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
            <th>Tên danh mục</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_category_product as $key => $cate_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $cate_pro->category_name }}</td>
            <td><span class="text-ellipsis">
                <?php
                if($cate_pro->category_status==0){
                    ?>
                    <a href="{{URL::to('/unactive-category-product/'.$cate_pro->category_id)}}"><i class="fas fa-eye-slash" style="font-size: 20px; margin-left: 10px;"></i></a>';
                <?php
                }else{
                ?>               
                <a href="{{URL::to('/active-category-product/'.$cate_pro->category_id)}}"><i class="fas fa-eye" style="font-size: 20px;margin-left: 10px;"></i></a>';
                <?php
                }

                ?>
            </span></td>
            
            <td>
              <a href="{{URL::to('/edit-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
              <a onclick="return confirm('Xác nhận xóa danh mục?')" href="{{URL::to('/delete-category-product/'.$cate_pro->category_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{ $all_category_product->links('pagination::bootstrap-4') }}
    <footer class="panel-footer">
      <div class="row">
        
        
        
      </div>
    </footer>
  </div>
</div>
        @endsection