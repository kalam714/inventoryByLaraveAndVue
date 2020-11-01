<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function todaySell(){
       $date=date('d/m/Y');
       $total=DB::table('orders')->where('order_date',$date)->sum('total');
       return response()->json($total);
    }
    public function todayIncome(){
        $date=date('d/m/Y');
        $total_pay=DB::table('orders')->where('order_date',$date)->sum('pay');
        return response()->json($total_pay);
    }
    public function todayDue(){
        $date=date('d/m/Y');
        $total_due=DB::table('orders')->where('order_date',$date)->sum('due');
        return response()->json($total_due);
    }
    public function todayExpense(){
        $date=date('Y/m/d');
        $total_expense=DB::table('expenses')->where('expense_date',$date)->sum('amount');
        return response()->json($total_expense);
    }
    public function stockOut(){
        $product=DB::table('products')->where('product_quantity','<','1')->get();
        return response()->json($product);
    }




}
