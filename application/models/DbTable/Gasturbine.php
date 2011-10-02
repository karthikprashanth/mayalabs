<?php

class Model_DbTable_Gasturbine extends Zend_Db_Table_Abstract {

    protected $_name = 'gasturbines';

    public function getGT($gtid) {
        $gtid = (int) $gtid;
        $row = $this->fetchRow('gtid = ' . $gtid);
        if (!$row) {
            throw new Exception("Could not find row $gtid");
        }
        return $row->toArray();
    }

    public function getGTP($pid){
        $pid = (int) $pid;
        $row = $this->fetchAll('plantId = ' . $pid);
        if(!$row){
            throw new Exception("Could not find row with plantId =  $pid");
        }
        return $row->toArray();
    }

    public function add($content) {
        
		$role = Zend_Registry::get('role');
		if($role == 'ca')
		{
			$umodel = new Model_DbTable_Userprofile();
			$user = $umodel->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
			$upid = $user['plantId'];
			$content['plantId'] = $upid;
		}

        $this->insert($content);
		$newid = $this->getAdapter()->lastInsertId();
        
        $nf = new Model_DbTable_Notification();
        $nf->add($this->getAdapter()->lastInsertId(), 'gasturbine', 1);
		return $newid;
    }

    public function updateGT($content) {
        $where = $this->getAdapter()->quoteInto('GTId = ?', $content['GTId']);
        $this->update($content, $where);
    }

    public function listGT() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $selectPlants = new Zend_Db_Select($db);
        $selectPlants->from('gasturbines');

        return $selectPlants;
    }
    
    public function getGTList()
    {
    	$row = $this->fetchAll();
    	return $row->toArray();
    }
    
    public function listPlantGt($pid)
    {
    	$db = Zend_Db_Table::getDefaultAdapter();
        $selectGt = new Zend_Db_Select($db);
        $selectGt->from('gasturbines')
        		 ->where('plantId = ?',$pid);

        return $selectGt;
    }
    
    public function listPlantGtArray($pid) {
    	$pid = (int) $pid;
        $row = $this->fetchAll('plantId = ' . $pid);
        if(!$row){
            throw new Exception("Could not find row with plantId =  $pid");
        }
        return $row->toArray();
    	
   	}
	

}

?>