<?php
namespace Home\Model;
use Think\Model\ViewModel;

class BlogViewModel extends ViewModel {
	protected $viewFields = array(
			'blog' => array(
				'id', 'title', 'time', 'click', 'summary',
				),
			'category' => array(
				'name', '_on' => 'blog.cid = category.id'
				)
			);
	
	public function getAll($where, $limit){
		return $this->where($where)->order('time DESC')->limit($limit)->select();
	}
}