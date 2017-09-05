<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\goodsRequest;
use App\Model\Attr;
use App\Model\Category;
use App\Model\Goods;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Goods::paginate(10);
        return view('admin.goods.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::get();
        $attr = Attr::where('pid',0)->get();
        return view('admin.goods.create',compact('category','attr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(goodsRequest $request,Goods $goods)
    {
        $request['click'] = $request['click'] ?:0;
        $request['attrs'] = json_encode($request['attrs'],JSON_UNESCAPED_UNICODE);
        $goods->create([
            'title'=>$request['title'],
            'shichangprice'=>$request['shichangprice'],
            'shangchengprice'=>$request['shangchengprice'],
            'attrs'=>$request['attrs'],
            'desc'=>$request['desc'],
            'content'=>$request['editorValue'],
            'click'=>$request['click'],
            'listimg'=>$request['listimg'],
            'category_id'=>$request['category_id'],
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Goods::find($id);
        $attr = Attr::where('pid',0)->get();
        $category = Category::get();
        return view('admin.goods.edit',compact('data','attr','category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Goods::find($id);
        $data->title = $request['title'];
        $data->listimg = $request['listimg'];
        $data->category_id = $request['category_id'];
        $data->shichangprice = $request['shichangprice'];
        $data->shangchengprice = $request['shangchengprice'];
        $data->click = $request['click'];
        $data->attrs = implode(',',$request['attrs']);
        $data->desc = $request['desc'];
        $data->content = $request['editorValue'];
        $data->save();
        return redirect('/admin/goods');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Goods::destroy($id);
        return ['valid'=>1,'message'=>'商品删除成功'];
    }


    public function getAttr($id){
        //$id是当前选择分类的id
        //用当前选择的分类id去属性表中找,那些属性可以被当前分类使用
        $attrs = Attr::where('category_id','like','%'.$id.'%')->get()->toArray();
        foreach ($attrs as $k => $v){
            $sonAttrs = Attr::where('pid',$v['id'])->get()->toArray();
//            echo '<pre>';
//            print_r($sonAttrs);
            $allAttrs[$v['title']] = $sonAttrs;
        }
        return ['data' => $allAttrs];
    }
}
