<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\Goods;//商品模型！
use App\Admin\Attr;//属性模型
use App\Admin\Huopin;//货品模型！

class GoodslistController extends Controller
{
//        货品方法  goodInfo 商品详情的意思
    public function index($goods_id){
        $goodsInfo  = Goods::find($goods_id);
        //获取当前商品所有货品
        $huopin = Huopin::where('goods_id',$goods_id)->get();//一定不要忘记加get()方法！
//                                                           可以继续分配这个参数
        return view('admin.goodslist.index',compact('goodsInfo','goods_id','huopin'));
    }



    public function add($goods_id){
        $goodsInfo  = Goods::find($goods_id);
        $goodsattr  =   explode(',',$goodsInfo['attrs']);//某条商品的字符串数据整成数组，存在变量
//        遍历这个带来的商品属性数组
        foreach ($goodsattr as $k => $v){//$v现在是4和7 id

            $attr = Attr::find($v)->toArray();
// 用属性模型在遍历find到4或者7的顶级属性！要以的数组的形式!存在一个变量中！将作为新数组的键名!


            //获取子属性，将作为新数组的键值
//       在通用属性模型去条件选择。Pid等于 $v顶级属性的ide的话,就以数组的形式获取！
            $sonattr = Attr::where('pid',$v)->get()->toArray();


//上面写好的$attr变量为 顶级属性！里面有顶级属性的数据！   $sonattr 通过where做出的为子属性！下面进行组数组！
            $newattr[$attr['title']] = $sonattr;
//            echo '<pre>';
//            print_r($sonattr);
        }
//   dd($newattr);
     return view('admin.goodslist.create',compact('goods_id','newattr'));//显示添加模板！
    }



//           添加方法
        public function store(Request $request,Huopin $huopin,$goods_id){
//            在 用货品模型去 调用create（）创建方法
         $huopin->create([
            'goods_id'=>$goods_id,  //货品表也存下商品的id
             'kucun'=>$request['kucun'],
             'attrs' => implode(',',$request['attrs']),//把数组进行分割成字符串！
         ]);
         return redirect('admin/goodslist/'.$goods_id);
        }




//    修改货品方法
        public function edit($goods_id,$huopin_id){
            $goods = Goods::find($goods_id);//获得商品id
            $huopin  = Huopin::find($huopin_id);//货品id
            $goodsInfo  =   explode(',',$goods['attrs']);//某条商品的字符串数据整成数组，存在变量
            //        遍历这个带来的商品属性数组
                foreach ($goodsInfo as $k=>$v){
//                     获得顶级属性当键名
                 $attr = Attr::find($v)->toArray();
//                        获得子属性当键值
                 $sonattr = Attr::where('pid',$v)->get()->toArray();

                 $newattr[$attr['title']] = $sonattr;

                }
//                                                      货品    三维数组！  商品id     货品id是为了传给更新方法使用！
            return view('admin.goodslist.edit',compact('huopin','newattr','goods_id','huopin_id'));//进入修改页面！
        }


//        修改之后更新方法
//原来给update方法带商品的参数是这个意思！因为最后我们还是要重定向跳走到其他页面index
//而进入index的路由本身是有参数的，如果不带回报错！Redirect(‘/admin/goodslist/’.$goods_id)  需要这种写法才能！.代表连接
            public function update(Request $request,$goods_id,$huopin_id){
              $Huopin = Huopin::find($huopin_id);//获取货品的某条！
              $Huopin ->goods_id = $goods_id;//直接用$good_id  不用能$request[]里面的了！
              $Huopin ->attrs = implode(',',$request['attrs']);
              $Huopin ->kucun = $request['kucun'];
              $Huopin ->save();//全部保存起来！
              return redirect('/admin/goodslist/'.$goods_id);
            }


        /**
         *      删除方法！
         */
        public function delete($huopin_id)
        {
            Huopin::destroy($huopin_id);//破坏性操纵！
            return ['valid'=>1,'message'=>'货品删除成功'];
        }
}
