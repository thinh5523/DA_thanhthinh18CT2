@extends('admin_layout')
@section('admin_content')
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh sách bình luận
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
            <th>Tên người bình luận</th>
            <th>Nội dung</th>
            <th>Ngày bình luận</th>
            <th>Sản phẩm</th>
            <th>Quản lý</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
            @foreach($comment as $key => $comm)
          <tr>
            <td>{{ $comm->comment_name }}</td>
            <td>{{ $comm->comment}}
              <ul style="color: blue; margin: 5px 30px;list-style-type: decimal;">
                <p style="color: black; margin-left: -30px;">Trả lời:</p>
                @foreach($comment_rep as $key => $comment_reply)
                  @if($comment_reply->comment_parent_comment==$comm->comment_id)
                    <li>{{ $comment_reply->comment }}</li>
                  @endif
                @endforeach 
              </ul>             
              <br/><textarea class="form-control reply_comment_{{ $comm->comment_id }}" rows="2"></textarea>
              <br/><button onclick="return confirm('Xác nhận trả lời bình luận?')" class="btn btn-default btn-xs btn-reply-comment" data-comment_id="{{ $comm->comment_id }}" data-product_id="{{ $comm->comment_product_id }}">Trả lời bình luận</button>
            </td>
            <td>{{ $comm->comment_date}}</td>
            {{-- chua fixx --}}
            {{-- href="{{ url('/chi-tiet-san-pham/.$comm->product->product_name ') }}" --}}
            <td><a target="_blank">{{ $comm->product->product_name}}</a></td>
            
            
            <td>
              
              <a onclick="return confirm('Xác nhận xóa bình luận?')" href="{{URL::to('/delete-comment/'.$comm->comment_id)}}" class="active styling-edit" ui-toggle-class="" style="margin-left: 15px;">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach

        </tbody>

      </table>
      
    </div>
    
  </div>
</div>
        @endsection