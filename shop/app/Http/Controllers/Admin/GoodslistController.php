<?php

namespace App\Http\Controllers\Admin;

use App\Model\Attr;
use App\Model\Goods;
use App\Model\Huopin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodslistController extends Controller
{
    public function index($goods_id){
        $goodsInfo = Goods::find($goods_id);
        //获取当前商品所有货品
        $huopin = Huopin::where('goods_id',$goods_id)->get();
        return view('admin.goodslist.index',compact('goodsInfo','goods_id','huopin'));
    }

    public function add($goods_id){
        $goodsInfo = Goods::find($goods_id)->toArray();
        $goodsInfo['attrs'] = json_decode($goodsInfo['attrs'],true);
        return view('admin.goodslist.create',compact('goods_id','goodsInfo'));
    }


    public function store(Request $request,Huopin $huopin,$goods_id){
        $huopin->create([
           'goods_id' => $goods_id,
            'kucun' => $request['kucun'],
            'attrs' => implode(',',$request['attrs']),
        ]);
        return redirect('admin/goodslist/'.$goods_id);
    }
}
