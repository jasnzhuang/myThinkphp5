<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;

Route::get('/tieba$', 'tieba/index/index');
Route::get('/tieba/ba/[:tieba_id]', 'tieba/index/ba');
Route::get('/tieba/tiezi/:tieziid/[:tieba_id]','tieba/index/tiezi');
Route::get('/tieba/createba$','tieba/index/createba');
Route::post('/tieba/docreateba','tieba/index/docreateba');
Route::get('/tieba/posttiezi/[:tieba_id]','tieba/index/posttiezi');
Route::post('/tieba/doposttiezi/[:tieba_id]','tieba/index/doposttiezi');




return [

	// 全局变量规则定义
	'__pattern__' => [
		'name' => '\w+',
		'id' => '\d+',
	],


];