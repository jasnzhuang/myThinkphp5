<?php
namespace app\blog\model;
use think\Model;
class Blog extends Model
{

//获取博客所属的用户

	public function user()
	{
		return $this->belongsTo('User');
	}

//获取博客的内容

	public function content()
	{
		return $this->hasOne('Content');
	}

//获取所有博客所属的分类

	public function cate()
	{
		return $this->belongsTo('Cate');
	}

//获取所有针对文章的评论

	public function comments()
	{
		return $this->morphMany('Comment', 'commentable');
	}
}