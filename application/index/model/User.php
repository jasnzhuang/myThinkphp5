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

	// sex读取器
	protected function getSexAttr($sex)
	{
		if ($sex==1) {
			$sex="男";
		} else {
			$sex="女";
		}
		
		return $sex;
	}

	// sex修改器
	protected function setSexAttr($value)
	{
		if ($value=="男") {
			$value="1";
		} else {
			$value="2";
		}
		
		return $value;
	}
}