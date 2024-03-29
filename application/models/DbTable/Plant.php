<?php

class Model_DbTable_Plant extends Zend_Db_Table_Abstract {

    protected $_name = 'plants';
	
	protected $plantId;
	protected $plantName;
	protected $corporateName;
	
    /*function __construct()
	{
		
	}*/
    
    public function getPlant($pid) {
        try {
	        $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
	        $stmt = $dbAdapter->query("SELECT * FROM plants where plantId = $pid");
	        $row = $stmt->fetchAll();
			array($row);
			return $row[0];
        }
        catch(Exception $e) {
            echo $e;
        }
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
		unset($content['modeselect']);
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