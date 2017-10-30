<?php
namespace app\demo\controller;
use think\Controller;
use think\Db;

class Index extends Controller
{
	public function index()
	{
		return "你现在访问的是demo模块的index控制器下面的index类里面的index方法<br>对应的网址应该是http://aajz.cn/index.php/demo/index/index";
	}
	public function hello()
	{
		return "你现在访问的是demo模块的index控制器下面的index类里面的hello方法<br>对应的网址应该是http://aajz.cn/index.php/demo/index/hello";
	}
	public function bye()
	{
		return "你现在访问的是demo模块的index控制器下面的index类里面的bye方法<br>对应的网址应该是http://aajz.cn/index.php/demo/index/bye";
	}
	public function show($num='123')
	{
		$this->assign('num2', $num);
		return $this->fetch();
	}
	public function readdb()
	{
		// $data = Db::name('data')->find();
		// $this->assign('result', $data);
		// return $this->fetch();
		// $data=Db::query('select * from think_data where id=9');
		// $this->assign('result', $data);
		// return $this->fetch();
		// $result = Db::name('data')->select();
		// dump($result);
		$data = Db::name('data')->select();
		$this->assign('result', $data);
		return $this->fetch();
	}
}
