<?php
	class Model_DbTable_Gallery extends Zend_Db_Table_Abstract {
		protected $_name = 'confgallery';
		
		public function getGallery($id){
			$row = $this->fetchAll('cId = ' . $id);
			return $row->toArray();
		}
		
	}