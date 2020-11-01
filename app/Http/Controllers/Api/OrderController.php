<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use DateTime;
class OrderController extends Controller
{
    public function TodaysOrder(){
        $date=date('d/m/Y');
        $order=DB::table('orders')->join('customers','orders.customer_id','customers.id')->where('order_date',$date)
                          ->select('customers.name','orders.*')->orderBy('orders.id','DESC')->get();
                          return response()->json($order);
                          

    }

    public function orderDetails($id){
       $order= DB::table('orders')->join('customers','orders.customer_id','customers.id')->where('orders.id',$id)
        ->select('customers.name','customers.address','customers.phone','orders.*')->first();
        return response()->json($order);

    }
    public function orderDetailsAll($id){
        $details=DB::table('order_details')->join('products','order_details.product_id','products.id')
                                           ->where('order_details.order_id',$id)
                                           ->select('products.product_name','products.product_code','products.image',
                                              'order_details.*')->get();
                                            return response()->json($details);

    }


    public function searchOrderByDate(Request $request){
        $odate=$request->date;
        $ndate=new DateTime($odate);
        $date=$ndate->format('d/m/Y');

        $order= DB::table('orders')->join('customers','orders.customer_id','customers.id')->where('orders.order_date',$date)
                                    ->select('customers.name','orders.*')->get();
                                     return response()->json($order);
    }
}
