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

return [

	// 全局变量规则定义
	'__pattern__' => [
		'name' => '\w+',
		'id' => '\d+',
	],
	'[hello]'     => [
		':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
		':name' => ['index/hello', ['method' => 'post']],
	],

    // 添加路由规则 路由到 index控制器的hello操作方法
	'hello/[:name]$' => 'index/index/hello',

	// 配合入门手册第六章模型
	'user/index' => 'index/user/index',
	'user/create' => 'index/user/create',
	'user/add' => 'index/user/add',
	'user/add/' => 'index/user/add',
	'user/adddo' => 'index/user/adddo',
	'user/adddo/' => 'index/user/adddo',
	'user/addadd' => 'index/user/addadd',
	'user/add_list' => 'index/user/addList',
	'user/edit/:id' => 'index/user/edit',
	'user/update/:id' => 'index/user/update?id=:id',
	'user/delete/:id' => 'index/user/delete',
	'user/:id' => 'index/user/read',
	'user' => 'index/user/index',
	'user/page/:page' => 'index/user/index?page=:page',
	'blog/add' => 'blog/index/add',
	'blog/adddo' => 'blog/index/adddo',
	'blog/:id' => 'blog/index/read',
	'blog/edit/:id' => 'blog/index/edit',
	'blog/update/:id' => 'blog/index/update?id=:id',
	'blog/delete/:id' => 'blog/index/delete',
	'blog/user/:id' => 'blog/index/user?id=:id',

];
