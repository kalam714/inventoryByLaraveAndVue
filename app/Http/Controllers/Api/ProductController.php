<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Image;
use App\Models\Product;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=DB::table('products')
                         ->join('categories','products.category_id','categories.id')
                         ->join('suppliers','products.supplier_id','suppliers.id')
                         ->select('categories.category_name','suppliers.shopname','products.*')
                         ->orderBy('products.id','DESC')
                         ->get();
                         return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData=$request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required'
         ]);

         if($request->image){

            $positon=strpos($request->image, ';');
            $sub=substr($request->image, 0,$positon);
            $ext=explode('/', $sub)[1];
            $name=time().".".$ext;
            $img=Image::make($request->image)->resize(240,200);
            $upload_path='backend/product/';
            $image_url=$upload_path.$name;
            $img->save($image_url);

         
         $product=new Product();
         $product->product_name=$request->product_name;
         $product->product_code=$request->product_code;
         $product->category_id=$request->category_id;
         $product->supplier_id=$request->supplier_id;
         $product->root=$request->root;
         $product->buying_price=$request->buying_price;
         $product->selling_price=$request->selling_price;
         $product->buying_date=$request->buying_date;
         $product->product_quantity=$request->product_quantity;
        
         $product->image=$image_url;
         $product->save();
         }else{
            $product=new Product();
            $product->product_name=$request->product_name;
            $product->product_code=$request->product_code;
            $product->category_id=$request->category_id;
            $product->supplier_id=$request->supplier_id;
            $product->root=$request->root;
            $product->buying_price=$request->buying_price;
            $product->selling_price=$request->selling_price;
            $product->buying_date=$request->buying_date;
            $product->product_quantity=$request->product_quantity;
            
             $product->save();
 
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return response()->json($product);
    }

   
    public function update(Request $request, $id)
    {

        $validateData=$request->validate([
            'product_name' => 'required',
            'product_code' => 'required',
            'product_quantity' => 'required'
         ]);
           $product=Product::find($id);
            $product->product_name=$request->product_name;
            $product->product_code=$request->product_code;
            $product->category_id=$request->category_id;
            $product->supplier_id=$request->supplier_id;
            $product->root=$request->root;
            $product->buying_price=$request->buying_price;
            $product->selling_price=$request->selling_price;
            $product->buying_date=$request->buying_date;
            $product->product_quantity=$request->product_quantity;
            
             $product->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $image=$product->image;
        if($image){
            unlink($image);
        }
        $product->delete();
    }
}
