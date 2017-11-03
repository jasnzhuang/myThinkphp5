<?php
namespace app\blog\model;
use think\Model;
class City extends Model
{

//获取城市的用户

public function users()
{
	return $this->hasMany('User');
}

//获取城市的所有博客

public function blog()
{
	return $this->hasManyThrough('Blog', 'User');
}
}