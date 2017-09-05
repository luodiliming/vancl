<?php
//路由：//返回的到静态资源resources文件夹中找welcomephp





//显示前台首页！
 Route::get('/','Index\EntryController@index');//@是方法！
//注册方法
 Route::get('/index/register','Index\RegisterController@register');//进入方法！
 Route::post('/index/register','Index\RegisterController@storeregister');//注册用户存储方法！
 Route::get('/index/login','Index\RegisterController@login');//前台登录页面展示路由！
 Route::post('/index/loginin','Index\RegisterController@loginin');//前台登录验证方法！
 Route::get('/index/loginout','Index\RegisterController@loginout');//前台登录页面展示路由！

 Route::get('/index/lists/{id}','Index\EntryController@lists');//前台点击商品顶级分类展示路由模板！ 带上了分类id
 Route::get('/index/xiangqing/{id}','Index\EntryController@xiangqing');//前台点击商品顶级分类展示路由模板！ 带上了分类id















 Route::any('/code','Code\CodeController@code');//注册验证码！
//Route::any() 路由。代表注册一个可以响应任何HTTP动作的路由，适用于上传功能
//上传功能路由！     这里没有路由组就必须要加前缀文件夹名了！
 Route::any('/component/upload','component\UploadController@uploader');
 Route::any('/component/filesLists','component\UploadController@filesLists');//这个是文件列表上传路由！



   //DIR相当于默认本地
include __DIR__.'/admin/web.php';

