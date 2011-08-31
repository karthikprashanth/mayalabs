<?php
	class Model_DbTable_Forum_Topics extends Zend_Db_Table_Abstract
	{
		protected $_name = 'forum_topics';
		
		public function getTopic($id)
		{	
			$row = $this->fetchRow('topic_id = '.$id);
			return $row->toArray();
			
		}
	}