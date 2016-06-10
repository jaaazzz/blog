<?php
namespace Admin\Model;

use Think\Model\RelationModel;

class BlogModel extends RelationModel{
	protected $_link = array(
				'attr' => array(
							'mapping_type' => self::MANY_TO_MANY,
							'foreign_key'  => 'bid',
							'relation_foreign_key' => 'aid',
							'relation_table' => 'admin_blog_attr',
						),
				'category' => array(
							'mapping_type' => self::BELONGS_TO,
							'foreign_key' => 'cid',
							'mapping_fields' => 'name',
							'as_fields' => 'name:cate',
						),
			);
}