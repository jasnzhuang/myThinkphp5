<?php
namespace app\tieba\model;
use think\Model;
class Tieba extends Model
{

//获取tieba下的所有tiezi信息

	public function tiezi()
	{
		return $this->hasMany('tiezi');
	}

}