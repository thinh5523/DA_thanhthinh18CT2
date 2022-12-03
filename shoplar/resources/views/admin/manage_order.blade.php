@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
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
            <th>Tên người đặt</th>
            <th>Tổng giá tiền</th>
            <th>Tình trạng</th>
            <th>Hiển thị</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($all_order as $key => $orders)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{ $orders->customers_name }}</td>
            <td>{{ number_format($orders->order_total+=Session::get('fee'),0,',','.').'đ' }}</td>
            <td>{{ $orders->order_status }}</td>
            
            <td>
              <a href="{{URL::to('/view-order/'.$orders->order_id)}}" class="active styling-edit" ui-toggle-class=""> 
                {{-- <i class="fa fa-pencil-square-o text-success text-active"> --}}<i class="fas fa-eye" style="margin-left: 5px; font-size: 20px;"></i></a>
              <a onclick="return confirm('Xác nhận xóa đơn hàng ?')" href="{{URL::to('/delete-order/'.$orders->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text" style="margin-left: 8px;"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $all_order->links('pagination::bootstrap-4') }}
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        
        
      </div>
    </footer>
  </div>
</div>
        @endsection