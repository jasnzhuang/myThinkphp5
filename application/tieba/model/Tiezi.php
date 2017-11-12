<?php
namespace app\tieba\model;
use think\Model;
class Tiezi extends Model
{
	protected static function init()
	{
		Tiezi::beforeInsert(function ($tiezi) {
			$tiezi->quote_id = 0;
			$tiezi->parent_id = 0;
			$tiezi->postdate = date("Y-m-d H:i:s");
		});
	}

	//获取tiezi所属的user
	public function user()
	{
		return $this->belongsTo('User');
	}



	//获取所有tiezi所属的tieba
	public function tieba()
	{
		return $this->belongsTo('Tieba');
	}


}