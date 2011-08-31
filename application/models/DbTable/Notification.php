<?php

class Model_DbTable_Notification extends Zend_Db_Table_Abstract {

    protected $_name = 'notification';

    public function add($id, $controller, $edit) {
        $currentdate = date('Y-m-d H:i:s');
        $uid = Zend_Auth::getInstance()->getStorage()->read()->id;
        $data['userupdate'] = $uid;
        $data['category'] = $controller;
        $data['catId'] = $id;
        $data['timeupdate'] = $currentdate;
        $data['edit'] = $edit; // add-> 1 ; edit-> 0
        $this->insert($data);
    }

    public function getNotifications() {

        $result = $this->fetchAll($this->select()->order('timeupdate DESC'));
        return $result->toArray();
    }

}

?>
