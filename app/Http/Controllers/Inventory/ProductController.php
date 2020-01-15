<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(){
        return view('Inventory.index');
    }
    public function getproducts(){
        $products = Product::all();
        return $products;
    }
    public function createproduct(Request $request){
        //todo validation
        $this->validate($request,[
            'product'=>'required',
            'quantity'=>'required',
            'price'=>'required',
            'category'=>'required',
        ]);
        Product::create([
            'product'=>$request->product,
            'quantity'=>$request->quantity,
            'price'=> $request->price,
            'category'=>$request->category,
            'description'=>$request->description,
            'supplier_id'=>$request->supplier
        ]);
        return 'Product Saved!';
    }
    public function update(Request $request) {
        //todo
        $product = Product::find($request->id);
        return 'update';
    }
    public function stats(Request $request){
        $stats = DB::table('order_product')->where('product', 'pencils')->where('collected',1)->get();
        return $stats;
    }
    public function destroy(Request $request){
        $product = Product::find($request);
        $product->delete();
        return 'product removed';
    }

}
