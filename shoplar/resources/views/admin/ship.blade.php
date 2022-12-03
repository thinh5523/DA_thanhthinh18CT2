@extends('admin_layout')
@section('admin_content')

<div class="form-w3layouts">
        <!-- page start-->
        <!-- page start-->
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm Phí vận chuyển
                        </header>
                        <?php
                        $message = Session::get('message');
                        if($message){
                            echo '<span class="text-alert">',$message.'</span>';
                            Session::put('message',null);
                        }
                        ?> 
            <div class="panel-body">
                <form class="form-horizontal bucket-form" method="get">
                    @csrf
                    <div class="form-group">
                        
                        <div class="col-lg-8" style="margin-left: 200px;">   
                        <label style="margin-left: -60px;" class="col-sm-3 control-label col-lg-3" for="inputSuccess">Chọn thành phố</label>                             
                            <select name="city" class="form-control m-bot15 choose city" id="city" style="margin-bottom: 30px;margin-left: px; ">
                                <option value="">--Chọn tỉnh thành phố--</option>
                            @foreach($city as $key => $ci)
                                <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                            @endforeach
                            </select>
                            <label style="margin-left: -45px;" class="col-sm-3 control-label col-lg-3  " for="inputSuccess">Chọn Quận/huyện</label>
                            <select class="form-control m-bot15 province choose" name="province" id="province" style="margin-bottom: 30px;">
                                <option value="">--Chọn quận huyện--</option>
                            @foreach($province as $key => $provinces)
                                <option value="{{$provinces->maqh}}">{{$provinces->name_quanhuyen}}</option>
                            @endforeach
                            </select>
                            <label style="margin-left: -55px;" class="col-sm-3 control-label col-lg-3 " for="inputSuccess">Chọn xã/phường</label>
                            <select class="form-control m-bot15 wards" name="wards" id="wards" style="margin-bottom: 30px;">
                                <option value="">--Chọn xã phường--</option>
                            @foreach($wards as $key => $wa)
                                <option value="{{$wa->xaid}}">{{$wa->name_xaphuong}}</option>
                            @endforeach
                            </select>
                            <div class="form-group">
                                    <label style="margin-left: 15px;" for="exampleInputEmail1">Phí vận chuyển</label>
                                    <input type="text" name="fee_ship" class="form-control fee_ship" id="exampleInputEmail1" style="width: 760px;margin-left: 15px;">
                                </div>
                            <button type="button" name="ship" class="btn btn-success ship">Thêm phí vận chuyển</button>
                        </div>
                    </div>      
                </form>
                        </div>
                <div id="load_ship">
                    
                </div>
                    </section>
                
            </div>
        <!-- page end-->
        </div>

@endsection