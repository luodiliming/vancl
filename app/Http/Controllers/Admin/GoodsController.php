<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\GoodRequest;//表单验证


use App\Admin\Goods;//商品列表的模型拿来
use App\Admin\Category;//种类
use App\Admin\Attr;//属性！


class GoodsController extends Controller
{
    /**
     * 展示主页面!
     * 模型调用get()
     */
    public function index()
    {

       $goods =  Goods::paginate(11);
       return view('admin.goods.index',compact('goods'));//找到index页面
    }

    /**
     * 添加方法！
     * 先遍历所属分类和商品属性这样才能添加成功！Use 引入Category所属分类和Attr商品属性模板得到数据！
     */
    public function create()
    {
        $category = Category::get();//获得种类模型的数据
        $attr  =  Attr::where('pid',0)->get();//获得最高的属性！那就where下 pid等于0!
       return view('admin.goods.create',compact('category','attr'));//显示添加模板！
    }

    /**
     *   存储方法！
     */
    public function store(GoodRequest $request,Goods $goods)
    {
//        我们通过三元表达点击量 因为你一开始没有点击量不可能会给空值的会报错 所以只有给0
        $request['click'] = $request['click'] ?:0;
//        然后在用$goods模型调用create（）方法创建

        $goods->create([
            'title'=>$request['title'], // =还是通过表单验证里面的内容，赋给这个字段！以此类推！
            'shichangprice'=>$request['shichangprice'],
            'shangchengprice'=>$request['shangchengprice'],
            'attrs'=>implode(',',$request['attrs']),
            'desc'=>$request['desc'],
            'content'=>$request['editorValue'],
            'click'=>$request['click'],
            'listimg'=>$request['listimg'],
            'category_id'=>$request['category_id'],

            'inseckill'=>$request['inseckill'],
            'intueijian'=>$request['intueijian'],
            'insellers'=>$request['insellers'],
            'inactivity'=>$request['inactivity'],
            'inmore'=>$request['inmore'],




        ]);
        return redirect('admin/goods');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * 编辑或修改方法
     */
    public function edit($id)
    {
          $data  = Goods::find($id);//商品
          $attr  = Attr::where('pid',0)->get();//最高属性！  记住不用get()方法你怎么拿数据！我丢
          $category = Category::get();//种类

//        dd(compact('data','attr'));
        return view('admin.goods.edit',compact('data','attr','category'));//进行数据分配
    }

    /**s
     * 上面修改之后还需要更新！
     */
    public function update(GoodRequest $request, $id)//还是表单验证！
    {
       $data = Goods::find($id);
//       然后$data得到里面的->title  =  表单验证里面得到的['title'] 赋给它  以此类推！
        $data->title = $request['title'];
        $data->listimg = $request['listimg'];
        $data->category_id = $request['category_id'];
        $data->shichangprice = $request['shichangprice'];
        $data->shangchengprice = $request['shangchengprice'];
        $data->click = $request['click'];
//import()方法是数组切割成字符串！因为在属性的name值给的是【】就可以选择多个，那么多个就成了一个数组。而数组是不能在存数组的。就需要切成字符串保存起来！
        $data->attrs = implode(',',$request['attrs']);
        $data->desc = $request['desc'];
        $data->content = $request['editorValue'];
        $data->save();//全部保存起来！
        return redirect('/admin/goods');
    }

    /**
     *      删除方法！
     */
    public function destroy($id)
    {
        Goods::destroy($id);//破坏性操纵！
        return ['valid'=>1,'message'=>'商品删除成功'];
    }
}
