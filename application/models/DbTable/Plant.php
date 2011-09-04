<?php

class Model_DbTable_Plant extends Zend_Db_Table_Abstract {

    protected $_name = 'plants';

    public function getPlant($pid) {
        $pid = (int) $pid;
        $row = $this->fetchRow('plantId = ' . $pid);
        if (!$row) {
            throw new Exception("Could not find row $pid");
        }
        return $row->toArray();
    }
    
    public function getPlantList()
    {
    	$row = $this->fetchAll();
    	return $row->toArray();
    }

    public function add($content) {
        $plantid = $this->insert($content);
        
        $nf = new Model_DbTable_Notification();
        $nf->add($this->getAdapter()->lastInsertId(), 'plant', 1);
        
        return $plantid;
    }

    public function updatePlant($plantId, $content) {
        $where = $this->getAdapter()->quoteInto('plantId = ?', $plantId);
        $this->update($content, $where);
    }

    public function listPlants() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $selectPlants = new Zend_Db_Select($db);
        $selectPlants->from('plants');
        return $selectPlants;
    }
    public function getPlantName($id) {
        $row = $this->fetchAll();
        $row->toArray();
        foreach ($row as $pDet) {
            if ($pDet['plantId'] == $id) {
                $pName = $pDet['plantName'];
            }
        }
        return $pName;
    }

    public function getPlantId($pName) {
        $row = $this->fetchAll();
        $row->toArray();
        foreach ($row as $pDet) {
            if ($pDet['plantName'] == $pName) {
                $pId = $pDet['plantId'];
            }
        }
        return $pId;
    }
    
    public function getSearchResults($term) {
    	try {
    	
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $dbAdapter->query("SELECT * FROM plants WHERE plantName like '%".$term."%' ORDER BY plantName");
        $row = $stmt->fetchAll();
        return $row;
        }
        catch(Exception $e) {
            echo $e;
        }
    } 
	
	public function getAllPlants()
	{
		try {
    	
        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $stmt = $dbAdapter->query("SELECT * FROM plants ORDER BY plantName");
        $row = $stmt->fetchAll();
        return $row;
        }
        catch(Exception $e) {
            echo $e;
        }
	}
	
	public function getCount()
	{
		$row = $this->fetchAll();
		return count($row);
	}
}

?>