<?php
class Model_DbTable_Forum_Users extends Zend_Db_Table_Abstract
{
	protected $_name = 'forum_users';
	
	public function updateEmail($id,$email)
	{
		$id = (int)$id;
		$data = array('user_email' => $email);
		$where['user_id = ?'] = $id;
		$this->update($data,$where);
	}
}