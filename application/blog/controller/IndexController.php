<?php
namespace app\blog\controller;

use app\blog\model\User;
use app\blog\model\Blog;
use app\blog\model\Content;
use app\blog\model\Cate;
use app\blog\model\City;
use app\blog\model\Comment;
use app\blog\model\Role;
use think\Request;
use think\Controller;

class IndexController extends Controller
{
	public function index()
	{
		$blogs = Blog::with('content')->select();
		foreach ($blogs as $blog) {
			dump($blog->content->data);
		}
	}

	public function add(){
		$blog = new Blog;
		$blog->name = 'thinkphp';
		$blog->title = 'ThinkPHP5关联实例';
		if ($blog->save()) {
			$content = new Content;
			$content->data = '实例内容';
			if($blog->content()->save($content)){
				echo "OK!";
			}else{
				echo "NOt OK!";
			}
		}
	}
	public function user($id)
	{
		$user = User::get($id);
		$this->assign('user',$user);
		return $this->fetch();

	}
}
