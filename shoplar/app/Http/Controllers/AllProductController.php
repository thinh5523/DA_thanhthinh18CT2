<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AllProductController extends Controller
{
    public function all_pet(){   
    	$cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
    	$brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderby('brand_id','desc')->get();

     
       	$all_pet = DB::table('tbl_product')->where('product_status','1')->orderby('product_id','desc')->paginate(16); 
       	// ->limit(16) gioi han sp hien thi trong muc TAT CA
      	return view('pages.allpet.all_pet')->with('category',$cate_product)->with('brand',$brand_product)->with('all_pet',$all_pet);

         $all_pet = DB::table('tbl_product')
         ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
         ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
         ->orderby('tbl_product.product_id','desc')->get();
         $manager_product = view('pages.allpet.all_pet')->with('all_pet',$all_pet);
         return view('pages.allpet.all_pet')->with('pages.allpet.all_pet', $manager_product);
      }
}
