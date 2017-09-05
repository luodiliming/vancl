<?php

namespace App\Http\Controllers\Index;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AddressController extends Controller
{
    public function index(){

        return view('index.address.address');
    }

    public function addAddress(Request $request){
        dd($request->all());
    }
}
