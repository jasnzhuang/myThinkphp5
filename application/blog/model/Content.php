<?php
namespace app\blog\model;
use think\Model;
class Content extends Model
{

//获取内容所属的博客信息

	public function blog()
	{
		return $this->belongsTo('Blog');
	}
}