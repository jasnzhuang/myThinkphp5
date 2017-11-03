<?php
namespace app\index\model;

use think\Model;

class User extends Model
{

//获取uesr所属的classes

	public function classes()
	{
		return $this->belongsTo('Classes');
	}

	// birthday读取器
	protected function getBirthdayAttr($birthday)
	{
		return date('Y-m-d', $birthday);
	}

	// birthday修改器
	protected function setBirthdayAttr($value)
	{
		return strtotime($value);
	}
}