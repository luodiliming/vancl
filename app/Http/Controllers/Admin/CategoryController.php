<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Admin\Category;//添加模型
use App\Http\Requests\categoryRequest;//表单验证！

class CategoryController extends Controller
{
    //展示
    public function index()
    {
        $data = Category::Paginate(10);//模型调用分页方法！ 需要在 index模板中放进一段代码{{ $users->links() }}
        return view('admin.category.index',compact('data'));//显示模板！在 分配上面存数据的变量！
    }

    //创建方法！  因为这个表里面需要数据，选择父级分类需要数据
    public function create()
    {
        $data = Category::get();//获得到Category模型也是表里面的所有数据 ，进行分配数据
        return view('admin.category.create',compact('data'));//显示添加模板！
    }

    /**
     *  储存post上来的东西!
     *为了做到更好。我们把简单的Requset不用。写一个表单验证，进行模型注入！和添加模型注入
     *
     * create新增数据的方法
     * 下面的思路是：添加注入模型调用新增数据create()方法 里面需要通过表单验证过后得到的所有数据。！all（）是获得所有数据！
     * 在 重定向走！会自动跳走会显示方法中
     */
    public function store(categoryRequest $request,Category $category)
    {
        $category->create($request->all());
        return redirect('admin/category');
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
     *  显示修改页面
     */
    public function edit($id)
    {
        $data = Category::find($id);//获得到哪条要修改的数据
        $category = Category::get();//这个是获得Catgory模型的所有数据，用来下来使用!
        return view('admin.category.edit',compact('data','category'));
    }

    /**
    *下面是更新方法！
    *这里是上面方法修改后post自动找的方法。这就是资源控制器的好处！带的修改的那条参数过来
     *
     *我们还是用到输入表单验证模型注入 ，后面是带来的修改那条的id
     *
     */
    public function update(categoryRequest $request, $id)
    {
        $category = Category::find($id);//获得一条数据存起
        $category->name = $request['name'];//Category表里面的name =  通过表单验证的name
        $category->pid = $request['pid'];
        $category->save();//存起来
        return redirect('admin/category');
    }

    /**
     * //下面是删除
     *

     */
    public function destroy($id)
    {
        Category::destroy($id);//直接用模型调用删除方法  删除！  一定要用破坏操作才行！
        return ['valid'=>1,'message'=>'商品分类删除成功'];
        //返回1  并说 一句话！  在index  上有js的确认删除吗   这是js的东西！
    }
}
