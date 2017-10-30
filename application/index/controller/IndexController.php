<?php
namespace app\index\controller;
// class index
// {

// 	// 这里呢，用一个范例的访问地址来说明到底怎么个用法
// 	//http://aajz.cn/index.php/index/index/byebye?name=123
// 	public function byebye($name = '123')
// 	{
// 		return 'bye bye,' . $name . '！';
// 	}
// }

use think\Controller;
use think\Db;

class IndexController extends Controller
{
	public function index()
	{
		$data = Db::name('data')->select();
		$this->assign('result', $data);
		return $this->fetch();
	}
	
	// 	// 这里呢，用一个范例的访问地址来说明到底怎么个用法
// 	// http://aajz.cn/index.php/index/index/index?name=123
// 	// http://aajz.cn/index.php/index/index/?name=123
// 	// http://aajz.cn/index.php/index/?name=123
// 	// http://aajz.cn/index.php/?name=123
// 	// http://aajz.cn/?name=123
	public function hello($name = 'World')
	{
		return 'Hello,' . $name . '！';
	}
}