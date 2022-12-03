<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\http\Requests;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Rating;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
	public function AuthLogin(){
         $admin_id = Session::get('admin_id');
         if($admin_id){
            return Redirect::to('dashboard');
         }else{
            return Redirect::to('admin')->send();
         }
      }
   public function reply_comment(Request $request){
      $data = $request->all();
      $comment = new Comment();
      $comment->comment = $data['comment'];
      $comment->comment_product_id = $data['comment_product_id'];
      $comment->comment_parent_comment = $data['comment_id'];
      $comment->comment_name = 'Petshop';
      $comment->save();
   }
   public function list_comment(){
      $comment = Comment::with('product')->where('comment_parent_comment','=',0)->orderby('comment_id','DESC')->get();
      $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
      return view('admin.list_comment')->with(compact('comment','comment_rep'));
   }
   public function send_comment(Request $request){
      $product_id = $request->product_id;
      $comment_name = $request->comment_name;
      $comment_content = $request->comment_content;
      $comment = new Comment();
      $comment->comment = $comment_content;
      $comment->comment_name = $comment_name;
      $comment->comment_product_id = $product_id;
      $comment->comment_parent_comment = 0;
      $comment->save();
   }
   public function delete_comment($comment_id){
      $this->AuthLogin();
         DB::table('tbl_comment')->where('comment_id',$comment_id)->delete();
         Session::put('message','Xóa bình luận thành công');
         return Redirect::to('comment');
   }
   // cmt
   public function load_comment(Request $request){
      $product_id = $request->product_id;
      $comment= Comment::where('comment_product_id',$product_id)->where('comment_parent_comment','=',0)->get();
      $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->get();
      $output = '';
      foreach($comment as $key => $cmt){
         $output.= '
         <div class="cmt-old">
                                <div class="cmt-user">

                                    <img class="image-cmt" src="'.url('/fontend/img/th.jpg').'">
                                </div>
                                <div class="cmt-user">
                                    <p class="cmtt">@'.$cmt->comment_name.'</p>
                                    <p class="cmtt-1">'.$cmt->comment_date.'</p>
                                    <p class="cmtt-2">'.$cmt->comment.'</p>
                                </div>
                            </div>
                            ';
                            foreach($comment_rep as $key => $rep_comment){
                              if($rep_comment->comment_parent_comment==$cmt->comment_id){
                            $output.= ' <div class="cmt-old-1">
                                <div class="cmt-user">

                                    <img class="image-cmt" src="'.url('/fontend/img/2.png').'">
                                </div>
                                <div class="cmt-user">
                                    <p class="cmtt">@Petshop-Admin</p>
                                    <p class="cmtt-1">'.$rep_comment->comment_date.'</p>
                                    <p class="cmtt-2">'.$rep_comment->comment.'</p>
                                </div>
                            </div>';
                            }
                        }
      }
      echo $output;
   }
    public function add_product(){
    	$this->AuthLogin();
    	$cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();

        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product',$brand_product);
   	}

   	public function all_product(){
   		$this->AuthLogin();
   		$all_product = DB::table('tbl_product')
   		->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
   		->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
   		->orderby('tbl_product.product_id','desc')->paginate(15);
   		$manager_product = view('admin.all_product')->with('all_product',$all_product);
   		return view('admin_layout')->with('admin.all_product', $manager_product);
   	}
   	public function save_product(Request $request){
   		$this->AuthLogin();
   		$data = array();
   		$data['product_name'] = $request->product_name;
   		$data['product_price'] = $request->product_price;
   		$data['product_desc'] = $request->product_desc;
   		$data['product_content'] = $request->product_content;
   		$data['category_id'] = $request->product_cate;
   		$data['brand_id'] = $request->product_brand;
   		$data['product_status'] = $request->product_status;
   		$get_image = $request->file('product_image');

   		if($get_image){
   			$get_name_image = $get_image->getClientOriginalName();
   			$name_image = current(explode('.',$get_name_image));
   			$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('uploads/product',$new_image);
   			$data['product_image'] = $new_image;
   			DB::table('tbl_product')->insert($data);
	   		Session::put('message','Thêm sản phẩm thành công');
	   		return Redirect::to('all-product');
   		}
   		$data['product_image'] = '';
   		DB::table('tbl_product')->insert($data);
   		Session::put('message','Thêm sản phẩm thành công');
   		return Redirect::to('all-product');
   	}
   	public function unactive_product($product_id){
   		$this->AuthLogin();
   		DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
   		Session::put('message','Hiển thị sản phẩm thành công');
   		return Redirect::to('all-product');
   	}
   	public function active_product($product_id){
   		$this->AuthLogin();
   		DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
   		Session::put('message','Ẩn sản phẩm thành công');
   		return Redirect::to('all-product');
   	}
      public function edit_product($product_id){
      	$this->AuthLogin();
      	 $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
    	 $brand_product = DB::table('tbl_brand')->orderby('brand_id','desc')->get();
         $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
         $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)
         ->with('brand_product',$brand_product);
         return view('admin_layout')->with('admin.edit_product', $manager_product);
      }
      public function update_product(Request $request,$product_id){
      	 $this->AuthLogin();
         $data = array();
         $data['product_name'] = $request->product_name;
	   	 $data['product_price'] = $request->product_price;
	   	 $data['product_desc'] = $request->product_desc;
	   	 $data['product_content'] = $request->product_content;
	   	 $data['category_id'] = $request->product_cate;
	   	 $data['brand_id'] = $request->product_brand;
	   	 $data['product_status'] = $request->product_status;
	   	 $get_image = $request->file('product_image');

	   	 if($get_image){
   			$get_name_image = $get_image->getClientOriginalName();
   			$name_image = current(explode('.',$get_name_image));
   			$new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
   			$get_image->move('uploads/product',$new_image);
   			$data['product_image'] = $new_image;
   			DB::table('tbl_product')->where('product_id',$product_id)->update($data);
	   		Session::put('message','Cập nhật sản phẩm thành công');
	   		return Redirect::to('all-product');
	    }
	   	DB::table('tbl_product')->where('product_id',$product_id)->update($data);
	   	Session::put('message','Cập nhật sản phẩm thành công');
	   	return Redirect::to('all-product');
	  }
      public function delete_product($product_id){
      	 $this->AuthLogin();
         DB::table('tbl_product')->where('product_id',$product_id)->delete();
         Session::put('message','Xóa sản phẩm thành công');
         return Redirect::to('all-product');
      }
      //End admin pages
      public function details_product($product_id){
         $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
         $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();
         $details_product = DB::table('tbl_product')
         ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
         ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
         ->where('tbl_product.product_id',$product_id)->get();

         foreach($details_product as $key => $value){
            $category_id = $value->category_id;
            $product_id = $value->product_id;
         }

         $related_product = DB::table('tbl_product')
         ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
         ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
         ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->limit(4)->get();

         $rating = Rating::where('product_id',$product_id)->avg('rating');
         $rating = round($rating);

         return view('pages.sanpham.show_details')->with('category',$cate_product)->with('brand',$brand_product)->with('product_details',$details_product)->with('relate',$related_product)->with('rating',$rating);
      }
      public function insert_rating(Request $request){
         $data = $request->all();
         $rating = new Rating();
         $rating->product_id = $data['product_id'];
         $rating->rating= $data['index'];
         $rating->save();
         echo 'done';
      }
}
