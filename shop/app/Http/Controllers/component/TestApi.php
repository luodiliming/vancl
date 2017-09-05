<?php

namespace App\Http\Controllers\component;

use App\Model\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestApi extends Controller
{
    public function orderQuery($id){
        $orderInfo = Order::find($id);
        if ($orderInfo['status'] == 1){
            return ['isOrder' => 1,'message' => '订单已支付'];
        }
        return ['isOrder' => 0,'message' => '订单尚未支付'];




    }
}
