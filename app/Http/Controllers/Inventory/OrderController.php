<?php

namespace App\Http\Controllers\Inventory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $count = 0;
    public $info = [];
    public function placeorder(Request $request)
    {
        //todo probably code
        if ($request->has('order_code')) {
            // echo('here');
            // $order = DB::table('orders')
            //     ->where('order_code', $request->order_code)
            //     ->update(['status' => 1]);
            $product = DB::table('order_product')->where('order_code', $request->order_code)->pluck('product_id');
            // print_r($p[0]);
            // return $product;
            for ($cc = 0; $cc < count($product); $cc++) {
                $p = Product::find($product[$cc]);
                $info = DB::table('order_product')->where('order_code', $request->order_code)
                    ->where('product_id', $product[$cc])->pluck('quantity');
                // return $info;
                $p->quantity = $p->quantity - $info[0];
                $p->save();
                // return response()->json($product[$cc]->product);
                // return $s[$cc];
            }

            return response()->json(['status' => 'order completed']);
        } else {
            $order = Order::create([
                'order_code' => $request->code,
                'customer_id' => $request->id,
                // 'paid'=>$request->paid,
                'date_placed' => $request->date_placed,
                'total' => $request->total,
                'details' => $request->details
            ]);
            // $id = $order->id;
            // return $order->id;
            $cart = $request->cart;
            //check quantity
            foreach ($cart as $key => $value) {
                //    return $value['product'];
                $product = Product::where('product', $value['product'])->get();
                // return $product[0]['quantity'];
                if ($value['quantity'] > $product[0]['quantity']) {
                    array_push($this->info, $value['product'], $product[0]['quantity']);
                }
            }
            // echo('here');
            if (count($this->info) > 0) {
                return response()->json(['data' => $this->info, 'status' => 'wrong']);
            } else {
                foreach ($cart as $key => $value) {
                    $product = Product::where('product', $value['product'])->get();
                    $order->products()->attach(
                        $product[0]['id'],
                        [
                            'order_code' => $request->code,
                            'quantity' => $value['quantity'],
                            'product' => $value['product']
                        ]
                    );
                }
                return response()->json(['status' => 'Successful']);
            }
        }
    }
    public function getorders(Request $request)
    {
        //todo frontend and small backend join
        if ($request->has('status')) {
            if ($request->status == 0) {
                $order = Order::where('status', 0)->get();
                return $order;
            } elseif ($request->status == 1) {
                $order = Order::where('status', 1)->get();
                return $order;
            }
        } else {
            // $wrong = DB::table('orders')->join('order_product','orders.order_code','=','order_product.order_code')
            // ->join('parent','orders.customer_id','=','parent.id')
            // ->select('orders.id','orders.order_code','orders.status','orders.collected','orders.reference','orders.details','orders.total',
            // 'order_product.quantity','order_product.product_id','order_product.product','order_product.collected AS scollect','parent.name AS parent')->get();
            $order = Order::join('parent', 'orders.customer_id', '=', 'parent.id')->select('orders.id', 'orders.order_code', 'orders.status', 'orders.collected', 'orders.reference', 'orders.details', 'orders.total', 'parent.name AS customer')->get();
            foreach ($order as $key => $value) {
                if ($value->collected == 0) {
                    $this->count++;
                }
            }
            return response(['order' => $order, 'count' => $this->count]);
        }
    }
    public function fetchorder(Request $request)
    {
        $details = DB::table('order_product')->where('order_code', $request->code)->get();
        return $details;
    }
    public function collect(Request $request)
    {
        $order = Order::where('order_code',$request->code)
        ->update(['collected'=>1, 'date_shipped' => $request->day]);
        DB::table('order_product')->where('order_code',$request->code)->update(['collected'=>1 , 'date_shipped' => $request->day ]);
        return 'print receipt';
    }
}
