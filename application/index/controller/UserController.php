<?php
namespace app\index\controller;

use app\index\model\User;
use app\index\model\Classes;
use think\Request;
use think\Controller;
use think\Db;

// 注意这里，简单说来就是如果想要用view的模板页面输出
// 就必须让这个控制器类extends Controller
class UserController extends Controller
{

	// 获取用户数据列表
	public function index()
	{
		// 这句是输出全部
		//$list = User::all();
		// 这句还是全部输出，但是每3个分页
		// $list = User::paginate(3);
		// $this->assign('list', $list);
		// $this->assign('count', count($list));
		// return $this->fetch();

		// 这里演示一下如何使用join的方式查询数据库，User::后面紧跟的View
		// 说白了就是生成了一个临时视图
		$list = Db::view('user','id,nickname,email,birthday')
		->view('classes',['year,major,subclass'],'classes.id=user.classes')
		->paginate(3);
		$this->assign('list',$list);
		return $this->fetch();
	}


	public function add()
	{
		$list = Classes::all();
		$this->assign('list', $list);
		return $this->fetch();
	}

	// 新增用户数据
	// public function add()
	// {
	// 	$user = new User;
	// 	$user->nickname = '流年';
	// 	$user->email = 'thinkphp@qq.com';
	// 	$user->birthday = strtotime('1977-03-05');
	// 	if ($user->save()) {
	// 		return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
	// 	} else {
	// 		return $user->getError();
	// 	}
	// }

	// 注意和上面注释掉的部分的对比，上面的说白了就是直接把操作值写在了控制器里
	// 下面的呢，就是通过use了request，从而能够获取到post过来的值
	public function adddo(Request $request)
	{
		$user = new User;
		$user->nickname = $request->post('nickname');
		$user->email = $request->post('email');
		$user->birthday = strtotime($request->post('birthday'));
		$user->classes = $request->post('classes');
		if ($user->save()) {
			return '用户[ ' . $user->nickname . ':' . $user->id . ' ]新增成功';
		} else {
			return $user->getError();
		}
	}

	// 新增用户数据
	public function addadd()
	{
		$user['nickname'] = '看云';
		$user['email'] = 'kancloud@qq.com';
		$user['birthday'] = strtotime('2015-04-02');
		if ($result = User::create($user)) {
			return '用户[ ' . $result->nickname . ':' . $result->id . ' ]新增成功';
		} else {
			return '新增出错';
		}
	}

	// 批量新增用户数据
	//因为addList中是大写的L，所以请使用http://aajz.cn/user/add_list来执行该方法
	public function addList()
	{
		$user = new User;
		$list = [
			['nickname' => '张三', 'email' => 'zhanghsan@qq.com', 'birthday' => strtotime('1988-01-15')],
			['nickname' => '李四', 'email' => 'lisi@qq.com', 'birthday' => strtotime('1990-09-19')],
		];
		if ($user->saveAll($list)) {
			return '用户批量新增成功';
		} else {
			return $user->getError();
		}
	}


	// 读取用户数据
	public function read($id='')
	{
		$user = User::get($id);
		if ($user) {
			echo $user->nickname . '<br/>';
			echo $user->email . '<br/>';
		//因为模型里面应用了读取器，所以不用在这里转换日期显示的数据格式了
		// echo date('Y/m/d', $user->birthday) . '<br/>';
			echo $user->birthday . '<br/>';
			echo $user->classes . '<br/>';
		} else {
			echo "查无此狗";
		}
		
		
	}




	// 修改前显示用户数据
	public function edit($id)
	{
		$user = User::get($id);
		$this->assign('id', $user->id);
		$this->assign('nickname', $user->nickname);
		$this->assign('email', $user->email);
		$this->assign('birthday', $user->birthday);
		return $this->fetch();

	}

	// 直接把修改值写在控制器里面来进行指定id的更新
	// 更新用户数据
	// public function update($id)
	// {
	// 	$user = UserModel::get($id);
	// 	$user->nickname = '刘晨';
	// 	$user->email = 'liu21st@gmail.com';
	// 	$user->save();
	// 	return '更新用户成功';
	// }

	// 确认修改后更新用户数据
	public function update(Request $request,$id)
	{
		$user = User::get($id);
		$user->nickname =$request->post('nickname');
		$user->email = $request->post('email');
		$user->birthday =strtotime($request->post('birthday'));
		$user->save();
		return '更新用户成功';
	}

	// // 删除用户数据
	// public function delete($id)
	// {
	// 	$user = User::get($id);
	// 	if ($user) {
	// 		$user->delete();
	// 		return '删除用户成功';
	// 	} else {
	// 		return '删除的用户不存在';
	// 	}
	// }

	// 删除用户数据
	public function delete($id)
	{
		$result = User::destroy($id);
		if ($result) {
			return '删除用户成功';
		} else {
			return '删除的用户不存在';
		}
	}
}