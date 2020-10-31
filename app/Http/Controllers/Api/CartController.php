<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\Pos;

class CartController extends Controller
{
    public function addToCart(Request $request,$id){
      $product=DB::table('products')->where('id',$id)->first();
      $check=DB::table('pos')->where('product_id',$id)->first();
      if($check){
        DB::table('pos')->where('product_id',$id)->increment('product_quantity');
        $product=DB::table('pos')->where('product_id',$id)->first();
        $subtotal=$product->product_quantity * $product->product_price;
        DB::table('pos')->where('product_id',$id)->update(['sub_total' =>$subtotal]);

      }else{
      $data=array();
      $data['product_id']=$id;
      $data['product_name']=$product->product_name;
      $data['product_quantity']=1;
      $data['product_price']=$product->selling_price;
      $data['sub_total']=$product->selling_price;
      DB::table('pos')->insert($data);
      }
    }
    public function cartProduct(){
      $cart=Pos::all();
      return response()->json($cart);
    }
    public function removeCart($id){
      $cart=Pos::find($id);
      $cart->delete();
    }
    public function increment($id){
      $quantity=DB::table('pos')->where('id',$id)->increment('product_quantity');
      $product=DB::table('pos')->where('id',$id)->first();
      $subtotal=$product->product_quantity * $product->product_price;
      DB::table('pos')->where('id',$id)->update(['sub_total' =>$subtotal]);

    }
    public function decrement($id){
      $quantity=DB::table('pos')->where('id',$id)->decrement('product_quantity');
      $product=DB::table('pos')->where('id',$id)->first();
      $subtotal=$product->product_quantity * $product->product_price;
      DB::table('pos')->where('id',$id)->update(['sub_total' =>$subtotal]);
    }
}
