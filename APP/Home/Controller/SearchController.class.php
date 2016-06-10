<?php
namespace Home\Controller;

class SearchController extends CommonController{
	//搜索
	public function index(){
		$this->display('index');
	}
	
	//搜索
	public function search(){
		$keyword = '%'.$_GET['keyword'].'%';
		$where['title'] = array('like', $keyword);
		//$where['content'] = array('like', $keyword);
		//$where['_logic'] = 'OR';
		$this->search = M('blog')->field('title, id')->where($where)->select();
		$this->display('index');
	}
}