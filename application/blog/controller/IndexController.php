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

		public function user($id)
		{
			$user = User::get($id);
			$this->assign('user',$user);
			return $this->fetch();

		}
	}
