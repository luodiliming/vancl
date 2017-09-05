<?php

namespace App\Http\Controllers\Index;
//            echo '<pre>';
//            print_r($soncate);想看二级分类还必须要print_r打印才行！
use App\Admin\Attr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Admin\Category;//分类模型
use App\Admin\Goods;//商品模型数据
use App\Admin\Huopin;//货品表

class EntryController extends Controller
{
//    展示下拉的顶级属性和二级
    public function index(){

      $topcate = Category::where('pid',0)->get()->toArray();

     foreach ($topcate as $k => $v){
//        echo '<pre>';
//        print_r($v);
//         在拿子分类
      $soncate = Category::where('pid',$v)->get()->toArray();//where()条件，用分类模型的pid等于！id.就是他的子属性
//        组成三维数组！把遍历的主分类放在这里当键名 =  后面是刚刚获得的 子分类的变量！
//        $newcate[$v['name']] =$soncate;  相当与$v
         $topcate[$k]['son'] = $soncate;
//$topcate[$k] 就代表每个顶级分类！用$v是最加不进去的所以用$k  建立一个son的字段！是在顶级属性里面，在把子类分类追加到这个字段！
     }
//     dd($topcate);
////
//                获得商品是每日秒杀的数据分配！ 条件是每日推荐！
              $inseckill = Goods::where('inseckill','1')->get()->toArray();
//                   获得商品是新品推荐的数据分配！ 条件是每日推荐！
              $intueijian = Goods::where('intueijian','1')->get()->toArray();
//                  获得商品是当季热卖的数据分配！ 条件是每日推荐！
              $insellers = Goods::where('insellers','1')->get()->toArray();
//                   dd($insellers);
//        -----------------------------上面是拿得到下拉菜单数组的操作--------------
//                dd($inseckill)
//  --------
        return view('index.homepage.index',compact('topcate','inseckill','intueijian','insellers'));//分配三维数组！
    }






        //展示商品页面！
    public function lists($id){
//            点击分类

        $goods = Goods::where('category_id',$id)->where('inseckill',0)->where('intueijian',0)->get()->toArray();

        $soncate = Category::where('pid',$id)->get()->toArray();
        if(!empty($soncate)){   //判断有没有二级分类了 ！有的话就在拿
            foreach ($soncate as $v) {
//                echo '<pre>';
//                print_r($v);
//                          商品表的的 关联分类id 等于  二级分类的id  就拿出来
                $sonGoods = Goods::where('category_id',$v['id'])->where('inseckill',0)->where('intueijian',0)->get()->toArray();
                foreach ($sonGoods as $vv) {
                    $goods[] = $vv;           //商品的货品 追进去！
                }
            }
        }

//        顶级属性
        $topcate = Category::where('pid',0)->get()->toArray();//想获得一个实际的数组！用toArray()
        foreach ($topcate as $k => $v) {
            $soncate = Category::where('pid',$v)->get()->toArray();
            $topcate[$k]['son'] = $soncate;
        }

//·
////        上面是--为了显示下拉数据所做的-----
                return view('index.homepage.lists',compact('topcate','goods'));//展示页面

    }





//    展示详情页面
            public function xiangqing($id){

             $Huopin  = Huopin::where('goods_id',$id)->get()->toArray();
                foreach ($Huopin as $k => $v){
//                    把每一条的数据的属性分割成数组！
                  $attrs = explode(',',$v['attrs']);
//                    直接把商品当头。每个货品当键值就行了！

//                    $k就是每一条货品！$v追加不了！ 新建一个字段，存二维数组！ 就组成一个新数组!
                    $Huopin[$k]['son'] = $attrs;

                }


//            获得带来参数一条商品的数据
           $Goods =  Goods::where('id',$id)->get()->toArray();
                   dd($Huopin);




//                     顶级属性
                $topcate = Category::where('pid',0)->get()->toArray();//想获得一个实际的数组！用toArray()
                foreach ($topcate as $k => $v) {
                    $soncate = Category::where('pid',$v)->get()->toArray();
                    $topcate[$k]['son'] = $soncate;
                }
////        上面是--为了显示下拉数据所做的-----
            return view('index.homepage.xiangqing',compact('topcate','Goods','Huopin'));


            }
















}




//                        虽然写好了暂时还不需要

//        -------------------------------下面是拿顶级分类商品的集合体操作-----------------
//            比上面多个一个遍历
//               获得商品信息
//         首先要获取所有顶级分类的数据
//$topcate =  Category::where('pid',0)->get()->toArray();
////         在遍历顶级分类
//foreach ($topcate as $k => $v){
////                            二级分类
//    $soncate = Category::where('pid',$v['id'])->get()->toArray();
////                                商品的数据，还是需要遍历子级分类
////            print_r($soncate);
////            echo '<hr />';
//    foreach ($soncate as $kk => $vv){
//        //用子分类的id去商品表里找到属于该子分类的商品
//        $songoods  = Goods::where('category_id',$vv['id'])->get()->toArray();
////                echo '<pre>';
////                print_r($songoods);
////                echo '<hr />';
////                重组数组 遍历商品！ 我们只需要顶级和商品信息！因为下面的展示用！ 新建一个变量！
//        foreach ($songoods as $kkk => $vvv){
//            $newgoods[$v['name']][] = $vvv;
////                        新建变量顶级的name =  不在是赋值了。而是追加用[]    后面是商品的数据！
////                    我们遍历商品是目的是为了重组数组！把顶级的name当键名，把商品的信息当键值追加！
//        }
//    }



//<ul class="shirts-product-list">
//@foreach($goods as $v)
//                <li><a href="http://item.vancl.com/6378022.html" class="product-img"  target="_blank" title="">
//                        <img alt="" src="{{$v['listimg']}}" />
//                    </a><a title="{{$v['title']}}" class="tit" style="display:inline;" href="http://item.vancl.com/6378022.html">{{$v['title']}}</a><span class="price" style="display:inline;font-size:15px;padding:1px;">
//                &#165;{{$v['shangchengprice']}}</span>
//                </li>
//@endforeach
//            </ul>





