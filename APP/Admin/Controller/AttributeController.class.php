<?php
namespace Admin\Controller;

/**
 * 属性控制器
 * @author Administrator
 *
 */
class attributeController extends CommonController {
	//属性列表视图
	public function index(){
		$attr = M('attr')->select();
		$this->assign('attr', $attr)->display();
	}
	
	//添加属性视图
	public function addAttr(){
		$this->display();
	}
	
	//添加属性表单处理
	public function runAddAttr(){
		$name = trim(I('name'));
		if(empty($name)) {
			$this->error('名称不能为空！');
		}
		
		$db = M('attr');
		if($db->create()){
			if($db->add()){
				$this->success('添加成功！', U(MODULE_NAME.'/Attribute/index'));
			} else {
				$this->error('添加失败！');
			}
			
		}
	}
	
	//删除属性
	public function deleteAttr(){
		if(M('attr')->where(array('id' => I('id')))->delete()){
			$this->success('删除成功！', U(MODULE_NAME.'/Attribute/index'));
		} else {
			$this->error('删除失败！');
		}
	}
}