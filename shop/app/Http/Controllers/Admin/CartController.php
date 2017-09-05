<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cart;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class CartController extends Controller
{
    public function index(){

        $data = DB::table('carts')->leftJoin('goods', 'carts.id', '=', 'goods.id')->select('carts.*','goods.title')->where('userid',1)->get();
        $data = json_decode(json_encode($data,JSON_UNESCAPED_UNICODE),true);
        return view('index.cart.index',compact('data'));
    }

    public function addCart(Request $request,Cart $cart){
        $cart->create([
            'goods_id' => $request['goods_id'],
            'price' => $request['price'],
            'attrs' => $request['attrs'],
            'num' => $request['num'],
            'total' => $request['price'] * $request['num'],
            'userid' => 1
        ]);
//        flash()->overlay('加入购物车成功');
        return redirect('/goodsdetail');
    }

    public function addOrder(Request $request,Order $order){
        $orderId = time() . mt_rand(0,99999999);
//        $order->create([
//            'orderId' => $orderId,
//            'totalPrice' => $request['totalPrice'],
//            'address' => $request['address'],
//            'beizhu' => $request['beizhu']?:'',
//            'status' => 0,
//            'userid' => 1,
//            'goods_id' => 1,
//            'huopin_id' => 1
//        ]);
        $id = DB::table('orders')->insertGetId(
            [
                'orderId' => $orderId,
                'totalPrice' => $request['totalPrice'],
                'address' => $request['address'],
                'beizhu' => $request['beizhu']?:'',
                'status' => 0,
                'userid' => 1,
                'goods_id' => 1,
                'huopin_id' => 1
            ]
        );
        $info = DB::table('orders')->join('goods','orders.goods_id','goods.id')->select('orders.*','goods.title','goods.desc')->where('orders.id',$id)->first();
        $info = json_decode(json_encode($info,JSON_UNESCAPED_UNICODE),true);
        //获取商品信息,订单表和商品表关联
        $params = [
            'id' => $info['id'],
            'goods' => $info['title'],
            'orderId' => $info['orderId'],
        ];
        return view('index.cart.zhifu',compact('params'));
    }

    public function zhifu(){
        $params = [
            'goods' => '商品1号',
            'goodsattach' => '商品介绍',
            'orderId' => '11223344'
        ];
        return view('index.cart.zhifu');
    }
}
