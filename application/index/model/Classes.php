<?php
namespace app\index\model;

use think\Model;

class Classes extends Model
{

//获取班级的用户

	public function users()
	{
		return $this->hasMany('User');
	}
}