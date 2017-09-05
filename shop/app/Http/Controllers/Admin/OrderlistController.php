<?php

namespace App\Http\Controllers\Admin;

use App\Model\Attr;
use App\Model\Category;
use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Order::paginate(10);
        $status = [
            '0' => '未支付',
            '1' => '已支付',
            '2' => '已发货',
            '3' => '已收货',
            '4' => '已完成',
        ];
        foreach ($data as $v){
            $v['status'] = $status[$v['status']];
            $v['address'] = '上海市松江区松江工业区江田东路185号';
        }
        return view('admin.order.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Order::find($id);
        $data['address'] = '上海市松江区松江工业区江田东路185号';
        $status = [
            '0' => '未支付',
            '1' => '已支付',
            '2' => '已发货',
            '3' => '已收货',
            '4' => '已完成',
        ];
        $data['status'] = $status[$data['status']];
        return view('admin.order.show',compact('data','category','attr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function updateStatus($orderId){
        $orderInfo = Order::find($orderId);
        $orderInfo['status'] = 2;
        $orderInfo->save();
        return ['valid'=>1,'message'=>'订单状态修改成功'];

    }
}
