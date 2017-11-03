<?php
namespace app\blog\model;
use think\Model;
class User extends Model
{

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