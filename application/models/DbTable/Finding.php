<?php

class Model_DbTable_Finding extends Zend_Db_Table_Abstract {

    protected $_name = 'gtdata';

    public function getFinding($id) {
        $gtid = (int) $id;
        $row = $this->fetchRow('id = ' . $gtid);
        if (!$row) {
            throw new Exception("Could not find row $gtid");
        }
        return $row->toArray();
    }

    public function add($content) {
        $currentdate = date('Y-m-d H:i:s');
        $data = array_merge($content, array('updatedate' => $currentdate));
        $this->insert($data);
		
		$newId = $this->getAdapter()->lastInsertId();
		
		$searchIndex = new Model_SearchIndex();
		$searchIndex->updateIndex("gtdata",$newId);
		
        $nf = new Model_DbTable_Notification();
        $nf->add($newId, 'finding', 1);
    }

    public function updateFinding($content) {
        $this->update($content, $this->getAdapter()->quoteInto("id = ?", $content['id']));
    }

    public function deleteFinding($id) {
        $this->delete('id =' . (int) $id);
		$nf = new Model_DbTable_Notification();
		$nf->delete("category = 'finding' AND catid = " . (int)$id);
    }

    public function listFinding($id) {
        $row = $this->fetchAll("type = 'finding' AND gtid = " . $id);
		return $row->toArray();
    }
    
    public function listGTFindings($gtid) {
    	$gtid = (int) $gtid;
    	$row = $this->fetchAll('gtid = ' . $gtid);
    	return $row->toArray();
    }

}

?>