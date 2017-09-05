<?php
//后台路由组  公共用二个属性    路由前缀于命名空间
//路由传参数只需要一个{}就行 了

Route::group(['prefix'=>'admin','namespace'=>'Admin'], function () {
    Route::get('/login','LoginController@login');  //输入用户密码路由!  输入admin/login 会被路由get  自动找到Admin/类和方法！
    Route::post('/login','LoginController@loginin');//验证用户路由！      因为还是在admin/login 下面所以能post到   懂？
    Route::get('/index','LoginController@index');//验证用户路由！      因为还是在admin/login 下面所以能post到   懂？

//    后台退出路由
    Route::get('/loginout','LoginController@loginout');
//    修改密码
    Route::get('/changePassword','PasswordController@PasswordForm');//找到显示修改密码的模型
    Route::post('/changePassword','PasswordController@changePassword');//进入修改密码方法！
//   商品分类
    Route::resource('/category','CategoryController');//用资源控制器创建自动创建方法要用到resource！
    Route::resource('/attr','AttrController');//商品属性路由！
    Route::resource('/goods','GoodsController');//商品列表展示！

//    货品分类  因为带参数过来的。所以不能用资源路由了！
    Route::get('/goodslist/{goods_id}','GoodslistController@index');//找到index方法！带商品参数了！
    Route::get('/huopin/add/{goods_id}','GoodslistController@add');//这个是添加的路由！我也给他带商品参数了！
    Route::post('/goodslist/store/{goods_id}','GoodslistController@store');//添加货品的路由！
    Route::get('/huopin/edit/{goods_id}/{huopin_id}','GoodslistController@edit');//这是货品的修改！带了 商品id和货品id
    Route::post('/goodslist/{goods_id}/update/{huopin_id}','GoodslistController@update');//更新路由！
    Route::get('/goodslist/delete/{huopin_id}','GoodslistController@delete');//删除路由


});







