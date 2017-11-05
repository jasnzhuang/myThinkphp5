<?php
namespace app\blog\model;

use think\Model;

class User extends Model
{
	public function isValid()
	{
	}
	//不要对一个模型数据同时使用修改器和模型事件
	protected static function init()
	{
		User::beforeInsert(function ($user) {
			$user->reg_ip = request()->ip();
		});
		User::beforeWrite(function ($user) {
			$user->name = strtolower($user->name);
		});
	}


//获取用户所属的角色信息

	public function roles()
	{
		return $this->belongsToMany('Role', 'auth');
	}


//获取用户发表的博客信息

	public function blogs()
	{
		return $this->hasMany('Blog');
	}
//获取所有针对用户的评论
	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}

	public function classes()
	{
		return $this->belongsTo('Classes');
	}

// *
// * 注册一个新用户
// * @param array $data 用户注册信息
// * @return integer|bool 注册成功返回主键，注册失败-返回false
// *
	public function register($data = [])
	{
		$result = $this->validate(true)->allowField(true)->save($data);
		if ($result) {
			return $this->getData('id');
		} else {
			return false;
		}
	}
// *
// * 用户登录认证
// * @param string $username 用户名
// * @param string $password 用户密码
// * @return integer 登录成功-用户ID，登录失败-返回0或-1


	public function login($username, $password)
	{
		$where['username'] = $username;
		$where['status'] = 1;
		/* 获取用户数据 */
		$user = $this->where($where)->find();
		if ($user) {
			if (md5($password) != $user->password) {
				$this->error = '密码错误';
				return 0;
			} else {
				return $user->id;
			}
		} else {
			$this->error = '用户不存在或被禁用';
			return -1;
		}
	}
// *
// * 获取用户信息
// * @param integer $uid 用户主键
// * @return array|integer 成功返回数组，失败-返回-1

	public function info($uid)
	{
		$user = $this->where('id', $uid)->field('id,username,email,mobile,status')->find();
		if ($user && 1 == $user->status) {
// 返回用户数据
			return $user->hidden('status')->toArray();
		} else {
			$this->error = '用户不存在或被禁用';
			return -1;
		}
	}
// *
// * 获取用户角色
// * @return integer 返回角色信息或者返回-1

	public function role()
	{
		$uid = $this->getData('id');
		if ($uid) {
			$role = $this->getUserRole($uid);
			if ($role) {
				return $role;
			} else {
				$this->error = '用户未授权';
				return 0;
			}
		} else {
			$this->error = '请先登录';
			return -1;
		}
	}


	protected function getUserRole($uid)
	{
		return $this->table('role')->where('uid', $uid)->find();
	}


// User.birthday读取器
	protected function getBirthdayAttr($birthday)
	{
		return date('Y-m-d', $birthday);
	}

// User.birthday修改器
	protected function setBirthdayAttr($value)
	{
		return strtotime($value);
	}
// User.CreateTime读取器
	protected function getCreateTimeAttr($value)
	{
		return date('Y-m-d H:i:s', $value);
	}
// User.Title读取器
	protected function getUserTitleAttr($value,$data)
	{
		return $data['name'] . ':' . $data['nickname'];
	}
// 和读取器不同，修改器的属性必须是数据表中存在的字段，
// 否则修改器的值仅仅能作为数据辅助作用
// 也就是说不能在set下面方法的时候传入null
	protected function setUserTokenAttr($value, $data)
	{
		return md5($data['name'] . $data['birthday']);
	}
}
