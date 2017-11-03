<?php
namespace app\blog\model;
use think\Model;
class Comment extends Model
{

//获取评论对应的多态模型

	public function commentable()
	{
		return $this->morphTo();
	}
}