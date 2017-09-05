<?php

namespace App\Http\Controllers\Index;

use App\Model\Attr;
use App\Model\Category;
use App\Model\Goods;
use App\Model\Huopin;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use wxpay\nofity\PayNotifyCallBack;
class EntryController extends Controller
{
    public function detail(){
        //假定商品id为1，真实情况，根据跳转进入详情后的商品ID来获取商品数据
        $goods_id = 1;
        //获取商品信息
        $data = Goods::find($goods_id);
        $aa = Goods::where('id', $goods_id)->first()->toArray();
        $attr_arr = explode(',', $aa['attrs']);
        foreach ($attr_arr as $k => $v) {
            $key = Attr::find($v);
            $value = Attr::where('pid',$v)->get()->toArray();
            $newcate[$key->title] = $value;
        };
        return view('index.goods.detail',compact('data','newcate','goods_id'));
    }

    public function chakucun($id,$goods_id){

        $goods_id = 1;
        $kucun = Huopin::where(['attrs'=>$id,'goods_id'=>$goods_id])->first();

        return ['data'=>$kucun,'code'=>200];
    }

    public function index(){
        //所有顶级分类
//        $topcate = Category::where('pid',0)->get()->toArray();
//        foreach ($topcate as $v){
//
//            $soncate = Category::where('pid',$v['id'])->get()->toArray();
////            echo '<pre>';
////            print_r($soncate);
//            $newcate[$v['name']] = $soncate;
//
//        };
        //首先要获取所有顶级分类的数据
        $topcate = Category::where('pid',0)->get()->toArray();
        $newData = [];
        //循环顶级分类,用顶级分类的id去拿每个顶级分类下的子分类数据
        foreach ($topcate as $k => $v){
            $soncate = Category::where('pid',$v['id'])->get()->toArray();
//            echo '<pre>';
//            print_r($soncate);
            //用子分类的id去商品表里找到属于该子分类的商品
            foreach ($soncate as $key => $value){
                $songoods = Goods::where('category_id',$value['id'])->get()->toArray();
//                echo '<pre>';
//                print_r($songoods);
//                echo '<hr />';
                foreach ($songoods as $kk => $vv){
                    $newData[$v['name']][] = $vv;
                }

            }

        }

        return view('index.goods.index',compact('newData'));
    }

    public function success(){

        return view('index.success');
    }

    public function notify(){
//        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
        $postStr = file_get_contents('php://input');
        $data = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

        if(!empty($data) && $data->return_code == 'SUCCESS'){
//            PayNotifyCallBack::NotifyProcess($postStr);
            $goodsInfo = explode('-',$data->attach);
            $id = $goodsInfo[1];
            $orderInfo = Order::find($id);
            $orderInfo->status = 1;
            $orderInfo->beizhu = $data;
            $orderInfo->save();
        }
    }
}
