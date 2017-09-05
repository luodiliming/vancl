<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AttrRequest;
use App\Admin\Attr;//获得属性的模型得到数据！ 下面模型注入

class AttrController extends Controller
{
    /**
     *显示页面！
     */
    public function index()
    {
        $data=Attr::with(['parent'])->get();//with是框架中预加载多种关联！Parent 只是自关联里面加载的条件！好在主页面上
        return view('admin.attr.index',compact('data'));//进入主页
    }

    /**
     * 添加方法
     */
    public function create()
    {
        $data = Attr::get();
        return view('admin.attr.create',compact('data'));//进入添加页面！
    }

    /**
     * 添加完成之后会自动post到存储里面来！
     */
    public function store(AttrRequest $request,Attr $attr)//模型注入表单验证！ 和属性模型
    {
        $attr->create($request->all());//10:还是回到store方法中，只用$attr模型调用carate()创建方法里面在使用表单验证去调用all()  全部~
        return redirect('admin/attr');

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $attr = Attr::find($id);//获得模板中的某一条数据！
      $data = Attr::get();//获得所有数据
        return view('admin.attr.edit',compact('attr','data'));//修改页面！
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttrRequest $request, $id)//还是需要之前写的表单验证。后面的参数是带来的！
    {
        $data = Attr::find($id);//获得某一条参数
        $data->title = $request['title'];//存在的这个$data变量中的数据->title 获得里面的title    =  表单验证得来的输入的title ，赋值给$data ->title
        $data->pid = $request['pid'];
        $data->save();
        return redirect('admin/attr');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Attr::destroy($id);//破坏性删除方法
        return ['valid'=>1,'message'=>'商品属性删除成功'];
        //返回1  并说 一句话！  在index  上有js的确认删除吗   这是js的东西！
    }
}
