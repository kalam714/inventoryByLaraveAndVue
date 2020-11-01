<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class PosController extends Controller
{
    public function getProduct($id){
        $product=DB::table('products')->where('category_id',$id)->get();
        return response()->json($product);
    }
    public function orderDone(Request $request){
        $validation=$request->validate([
           'customer_id' =>'required'
        ]);
        $data=array();
        $data['customer_id']=$request->customer_id;
        $data['quantity']=$request->quantity;
        $data['vat']=$request->vat;
        $data['sub_total']=$request->subtotal;
        $data['total']=$request->total;
        $data['pay']=$request->pay;
        $data['due']=$request->due;
        $data['payby']=$request->payby;
        $data['order_date']=date('d/m/Y');
       $order_id=DB::table('orders')->insertGetId($data);

       $contents=DB::table('pos')->get();
       $odata=array();
       foreach($contents as $content){
           $odata['order_id']=$order_id;
           $odata['product_id']=$content->product_id;
           $odata['product_quantity']=$content->product_quantity;
           $odata['product_price']=$content->product_price;
           $odata['sub_total']=$content->sub_total;
           DB::table('order_details')->insert($odata);
           DB::table('products')->where('id',$content->product_id)
                                ->update(['product_quantity' => DB::raw('product_quantity -'.$content->product_quantity)]);

       }
       DB::table('pos')->delete();

    }
}
