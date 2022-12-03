<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\City;
use App\Models\Province;
use App\Models\wards;
use App\Models\Feeship;
session_start();

class CheckoutController extends Controller
{
    public function AuthLogin(){
         $customers_id = Session::get('customers_id');
         if($customers_id){
            return Redirect::to('payment');
         }else{
            return Redirect::to('login-checkout')->send();
         }
      }
    public function delete_fee(){
        Session::forget('fee');
        return redirect()->back();
    }
    public function calculate_fee(Request $request){
        $data = $request->all();
        if($data['matp']){
            $feeship = Feeship::where('fee_matp',$data['matp'])->where('fee_maqh',$data['maqh'])->where('fee_xaid',$data['xaid'])->get();
            if($feeship){
                $count_feeship = $feeship->count();
                if($count_feeship>0){
                    foreach($feeship as $key => $fee){
                Session::put('fee',$fee->fee_feeship);
                Session::save();
                    }
                }else{
                    Session::put('fee',35000);
                    Session::save();
                }
            }
            
        }
    }
    public function select_ship_home(Request $request){
        $data = $request->all();
      if($data['action']){
        $output .= '';
        if($data['action']=="city"){
          $select_province = Province::where('matp',$data['ma_id'])->orderby('maqh','ASC')->get();
            $output.='<option>---Chọn quận huyện---</option>';
          foreach($select_province as $key => $province){
            $output.='<option value="'.$province->maqh.'">'.$province->name_quanhuyen.'</option>';
          }

        }else{
          $select_wards = Wards::where('maqh',$data['ma_id'])->orderby('xaid','ASC')->get();
            $output.='<option>---Chọn xã phường---</option>';
          foreach($select_wards as $key => $ward){
            $output.='<option value="'.$ward->xaid.'">'.$ward->name_xaphuong.'</option>';
          }

        
          }
          echo $output;
        }
    }

      
    public function view_order($orderId){
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customers_id','=','tbl_customers.customers_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        // ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order.order_id', $orderId)
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*')->first();  

        
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);

    }
    public function login_checkout(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
    	return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function add_customer(Request $request){
    	$data = array();
    	$data['customers_name'] = $request->customers_name;
    	$data['customers_email'] = $request->customers_email;
    	$data['customers_password'] = md5($request->customers_password);
    	$data['customers_phone'] = $request->customers_phone;

    	$customers_id = DB::table('tbl_customers')->insertGetId($data);

    	Session::put('customers_id',$customers_id);
    	Session::put('customers_name',$request->customers_name);
    	return Redirect::to('/checkout');
    }
    public function checkout(){
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $city = City::orderby('matp','ASC')->get();
        $province = Province::orderby('maqh','ASC')->get();
        $wards = Wards::orderby('xaid','ASC')->get();
    	return view('pages.checkout.checkout')->with('category',$cate_product)->with('brand',$brand_product)->with('city',$city)->with('province',$province)->with('wards',$wards);


    }
    public function save_checkout_customer(Request $request){
    	$data = array();
    	$data['shipping_name'] = $request->shipping_name;
    	$data['shipping_email'] = $request->shipping_email;
    	$data['shipping_notes'] = $request->shipping_notes;
    	$data['shipping_phone'] = $request->shipping_phone;
    	$data['shipping_address'] = $request->shipping_address;

    	$shipping_id = DB::table('tbl_shipping')->insertGetId($data);

    	Session::put('shipping_id',$shipping_id);
    	return Redirect::to('/payment');
    }
    public function payment(){  
        $this->AuthLogin();    
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.checkout.payment')->with('category',$cate_product)->with('brand',$brand_product);

    }
    public function order_place(Request $request){
        // chèn payment_method
        // $content = Cart::content();
        // echo $content;
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);

        // chèn order
        $total =0;
        foreach(Session::get('cart') as $key => $cart){
                $subtotal = $cart['product_price']*$cart['product_qty'];
                $total+=$subtotal;
        }
        $order_data = array();
        $order_data['customers_id'] = Session::get('customers_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = $total;
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        // chèn order_details_data
        $content = Cart::content();
        // dd($content);
        foreach($content as $v_content){            
            $order_details_data['order_id'] = $order_id;
            $order_details_data['product_id'] = $v_content->id;
            $order_details_data['product_name'] = $v_content->name;
            $order_details_data['product_price'] = $v_content->price;
            $order_details_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_details_data);
        }
        if($data['payment_method']==1){
            echo 'Thanh toan ATM';
        }elseif($data['payment_method']==2){
             
            $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
            $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
            Cart::destroy();
            return view('pages.checkout.handcash')->with('category',$cate_product)->with('brand',$brand_product);

            
        }else{
            echo "Thẻ ghi nợ";
        }


        // return Redirect::to('/payment');
    }

    public function logout_checkout(){
    	Session::flush();
    	return Redirect::to('/login-checkout');
    }
    public function login_customer(Request $request){
    	$email = $request->email_account;
    	$password = md5($request->password_account);
    	$result = DB::table('tbl_customers')->where('customers_email',$email)->where('customers_password',$password)->first();
    	if($result){
    		Session::put('customers_id',$result->customers_id);
    		return Redirect::to('/checkout');
    	}else{
    		return Redirect::to('/login-checkout');
    	}
    	
    }
    public function manage_order(){
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers','tbl_order.customers_id','=','tbl_customers.customers_id')
        ->select('tbl_order.*','tbl_customers.customers_name')        
        ->orderby('tbl_order.order_id','desc')->paginate(12);
        $manager_order = view('admin.manage_order')->with('all_order',$all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
    public function delete_order($orders_id){
        DB::table('tbl_order')->where('order_id',$orders_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('manage-order');
    }
}
