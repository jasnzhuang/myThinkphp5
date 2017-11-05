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
use think\Session;

class IndexController extends Controller
{
	public function index()
	{
		$blogs = Blog::with('content')->paginate(3);
		$this->assign('blogs',$blogs);
		return $this->fetch();
	}


	public function add()
	{
		return $this->fetch();
	}

	public function adddo(Request $request){
		$blog = new Blog;
		$blog->name = $request->post('blogname');
		$blog->title = $request->post('blogtitle');
		if ($blog->save()) {
			$content = new Content;
			$content->data = $request->post('contentdata');
			if($blog->content()->save($content)){
				return 'Blog'.$blog->id.'发布成功!';
			}else{
				echo "Blog发布失败!";
			}
		}
	}

	public function read($id='')
	{
		$blog=Blog::get($id);
		$this->assign('blog',$blog);
		return $this->fetch();
	}

	public function edit($id)
	{
		$blog=Blog::get($id);
		$this->assign('blog',$blog);
		return $this->fetch();
	}

	public function update(Request $request,$id)
	{
		$blog = Blog::get($id);
		if ($blog) {

			$blog->save([
				'name' => $request->post('blogname'),
				'title' => $request->post('blogtitle'),
			]);
			$blog->content->save([
				'data' => $request->post('contentdata'),
			]);

		} else {
			return '查无此狗日志Blog！';
		}

	}


	public function delete($id)
	{
		// $blog->delete()这种使用模型来删除的方法，只能删除Blog的实例对象
		// 却无法删除和Blog关联的Content里面的实例对象
		// 所以额外加入了$blog->content->delete()
		$blog = Blog::get($id);
		if ($blog) {
			$blog->delete();
			$blog->content->delete();
			return '删除Blog成功';
		} else {
			return '删除的Blog不存在';
		}

	}
	//获取用户信息，仅供调试使用
	//正式场合这样用就泄密了，切记
	public function user($id)
	{
		$user = User::get($id);
		$this->assign('user',$user);
		return $this->fetch();

	}

	//登录页呈现方法
	public function login()
	{
		return $this->fetch();
	}

	//登录处理逻辑方法
	public function doLogin(User $user, $username, $password)
	{
		$uid = $user->login($username, $password);
		if ($uid) {
			Session::set('user_id', $uid);
			$this->success('登录成功');
		} else {
			$this->error('登录失败');
		}
	}

	//注册页呈现方法
	public function register()
	{
		return $this->fetch();
	}

	//注册页处理逻辑方法
	public function doRegister(User $user)
	{
		$data = $this->request->param();
		$result = $user->register($data);
		if ($result) {
			$this->success('用户注册成功');
		} else {
			$this->error($user->getError());
		}
	}

	//获取用户信息方法
	public function getUserInfo(User $user, $uid)
	{
		$info = $user->info($uid);
		if ($info) {
			$this->assign('user', $info);
			return $this->fetch();
		} else {
			return '用户不存在';
		}
	}

	//获得用户角色方法
	protected function getUserRole()
	{
		$uid = Session::get('user_id');
		$user = User::get($uid);
		return $user->role();
	}
}
