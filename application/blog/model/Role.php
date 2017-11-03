<?php
namespace app\blog\model;
use think\Model;
class Role extends Model
{
//获取角色下面的用户信息
	public function users()
	{
		return $this->belongsToMany('User', 'auth');
	}
}