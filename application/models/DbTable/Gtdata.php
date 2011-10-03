<?php

class Model_DbTable_Gtdata extends Zend_Db_Table_Abstract {

    protected $_name = 'gtdata';

    public function getData($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $pid");
        }
        return $row->toArray();
    }
    
    public function isGTBelong($id) {
    	$id = (int)$id;
    	
    	$gtdata = $this->fetchRow('id = ' . $id);
    	$gtdata = $gtdata->toArray();
    	$gtid = $gtdata['gtid'];
    	
    	$gtmodel = new Model_DbTable_Gasturbine();
    	$gt = $gtmodel->getGT($gtid);
    	
    	
    	$uid = Zend_Auth::getInstance()->getStorage()->read()->id;
    	$umodel = new Model_DbTable_Userprofile();
    	$user = $umodel->getUser($uid);
    	
    	if((int)$user['plantId'] == (int)$gt['plantId']) {
    		return true;
    	}
    	else {
    		return false;
    	}
     }
     
     public function getDataByType($gtid,$type)
     {
     	$row = $this->fetchAll("gtid = " . $gtid . " AND type = '" . $type . "'");
     	return $row->toArray();
     }
     
     public function getDataByGt($gtid)
     {
     	$row = $this->fetchAll("gtid = " . $gtid);
     	return $row->toArray();
     }
     
     public function getUnmailedData()
     {
     	$row = $this->fetchAll("mailed = 0");
     	return $row->toArray();
     }
     
     public function setMailed()
     {
     	$data = array('mailed' => 1);
     	$where['mailed = ?'] = 0;
     	$this->update($data,$where);
     }

	 public function getTypeCount($type,$id)
	 {
	 	$row = $this->fetchAll("gtid = " . $id . " AND type = '" . $type . "'");
		return count($row->toArray());
	 }
	 
	
}

?>