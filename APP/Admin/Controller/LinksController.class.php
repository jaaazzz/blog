<?php
namespace Admin\Controller;


class LinksController extends CommonController {
	//列表视图
    public function index(){
    	$this->links = M('links')->select();
    	
    	$this->display();
    }
    
    //增加视图
    public function addLink(){
    	$this->display();
    }
    
    //增加表单处理
    public function runAddLink(){
    	$db = M('links');
    	if($db->create()){
    		if($db->add()){
    			$this->success('增加成功！', U(MODULE_NAME.'/Links/index'));
    		} else {
    			$this->error('增加失败！');
    		}
    	}    	
    }
    
    //删除
    public function delete(){
    	if(M('links')->where(array('id' => I('id')))->delete()){
    		$this->success('删除成功！');
    	} else {
    		$this->error('删除失败！');
    	}
    }
    
    //修改视图
    public function update(){
    	$this->link = M('links')->find(I('id'));
    	$this->display();
    }
    
    //修改表单处理
    public function runUpdate(){
    	$data = array(
    			'name' => I('name'),
    			'url'   => I('url'),
    			'about'   => I('about'),
    			'remarks'   => I('remarks'),
    	);
    	if(M('links')->where(array('id' => (int)$_GET[id]))->save($data)){
    		$this->success('修改成功！', U(MODULE_NAME.'/Links/index'));
    	} else {
    		$this->error('修改失败！');
    	}
    }
}