<?php
namespace app\tieba\controller;

use app\tieba\model\Tieba;
use app\tieba\model\Tiezi;
use think\Request;
use think\Controller;
use think\Session;

class IndexController extends Controller
{
	public function index()
	{
		$tiebas = Tieba::paginate(6);
		$this->assign('tiebas',$tiebas);
		return $this->fetch();
	}

	public function ba(Request $request)
	{
		$tieba_id=$this->request->param('tieba_id');
		$tiezis=Tiezi::where("tieba_id",$tieba_id)
		->where("parent_id",0)
		->paginate(3);
		$this->assign('tiezis',$tiezis);
		$this->assign('tieba_id',$tieba_id);
		return $this->fetch();
	}

	public function tiezi(Request $request)
	{
		$tieziid=$this->request->param('tieziid');
		$contents=Tiezi::where("id",$tieziid)
		->whereOr("parent_id",$tieziid)
		->order("id asc")
		->select();
		$this->assign('contents',$contents);
		$this->assign('tieziid',$tieziid);
		return $this->fetch();
	}

	public function createba()
	{
		return $this->fetch();
	}

	public function docreateba(Request $request)
	{
		if ($this->request->isPost())
		{
			$tieba = new Tieba;
			$tieba->baname = $this->request->param('baname');
			if ($tieba->save()) {
				$this->success('新建成功', '/tieba');
			} else {
				$this->error('新建失败');
			}
		}else{
			$this->error('非法请求');
		}
	}

	public function posttiezi(Request $request)
	{
		$tieba_id= $this->request->param('tieba_id');
		$this->assign('tieba_id',$tieba_id);
		return $this->fetch();
	}

	public function doposttiezi(Request $request)
	{
		if ($this->request->isPost())
		{
			$tiezi = new Tiezi;
			$tiezi->title = $this->request->param('title');
			$tiezi->content = $this->request->param('content');
			$tiezi->tieba_id = $this->request->param('tieba_id');
			if ($tiezi->save()) {
				$this->success('发表成功', '/tieba');
			} else {
				$this->error('发表失败');
			}
		}else{
			$this->error('非法请求');
		}
	}
}
