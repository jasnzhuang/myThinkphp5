<?php
namespace app\blog\model;
use think\Model;
class Cate extends Model
{

//获取分类下的所有博客信息

	public function blogs()
	{
		return $this->hasMany('Blog');
	}
}