<?php

namespace App\Http\Controllers\Admin;

use App\Model\Attr;
use App\Model\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttrController extends CommonController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Attr $attr)
    {
//        $data = Attr::paginate(5);
        $data = Attr::with(['parent'])->get();
        return view('admin.attr.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attr = Attr::where('pid',0)->get();
        //获取所有子分类的数据
        $sonCategory = Category::where('pid','!=',0)->get()->toArray();
        return view('admin.attr.create',compact('attr','sonCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Attr $attr)
    {
        if($request['category_id']){
            $request['category_id'] = implode(',',$request['category_id']);
        }else{
            $request['category_id'] = '';
        }

        $attr->create($request->all());
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
        $data = Attr::find($id);
        $attr = Attr::get();
        return view('admin.attr.edit',compact('data','attr'));
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
        $data = Attr::find($id);
        $data->title = $request['title'];
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
        //
    }
}
