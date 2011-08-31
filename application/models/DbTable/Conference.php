<?php
	class Model_DbTable_Conference extends Zend_Db_Table_Abstract {
		protected $_name = 'conference';
		
		public function getConfDetail($cid){
				$cid = (int)$cid;
	            $row = $this->fetchRow('cId = ' . $cid);
	            if (!$row) {
	                    throw new Exception("Could not find row $cid");
	            }
	            return $row->toArray();
		}
		
		public function getConfList()
		{
			$select = $this->select()
						   ->order('year DESC');
			$rSet = $this->fetchAll($select);
			return $rSet->toArray();
		}
		
		public function updateConf($cid, $content) {
	        $where = $this->getAdapter()->quoteInto('cId = ?', $cid);
	        $this->update($content, $where);
	    }
	}