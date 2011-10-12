<?php

class Plugin_EditPermission extends Zend_Controller_Plugin_Abstract {

    protected $_view;

    public function preDispatch(Zend_Controller_Request_Abstract $request) {
        parent::preDispatch($request);
    }

    public function  dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        parent::dispatchLoopStartup($request);
        if($request->isXmlHttpRequest())
            return;
        if($request->getActionName()!='edit')
                if($request->getActionName()!='delete')
                        return;

        $valid = false;
		$role = Zend_Registry::get('role');
		if($role == 'sa')
		{
			$valid = true;
		}
        $controller = $request->getControllerName();
        $id = $request->getParam('id');
		if(!in_array($controller,array("gasturbine","plant","findings","findings","upgrades","lte")))
		{
			return;
		}
        $up = new Model_DbTable_Userprofile();
        $up = $up->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
        $pid = $up['plantId'];
        if ($controller == 'gasturbine') {
        	
            $gt = new Model_DbTable_Gasturbine();
            $gt = $gt->getGTP($pid);
            foreach ($gt as $temp) {
                if ((int)$temp['GTId'] == (int)$id) {
                    $valid = true;
                }
            }
        } else if ($controller == 'plant') {
            if((int)$pid == (int)$id){
                $valid = true;
                
            }
        } else if($controller == 'findings'){
            $gt = new Model_DbTable_Gasturbine();
            $gt = $gt->getGTP($pid);
            $fin = new Model_DbTable_Finding();
            $fin = $fin->getFinding($id);
            foreach ($gt as $temp){
                if((int)$temp['GTId'] == (int)$fin['gtid']){
                    $valid = true;
                }
            }
        } else if($controller == 'upgrades'){
            $gt = new Model_DbTable_Gasturbine();
            $gt = $gt->getGTP($pid);
            $fin = new Model_DbTable_Upgrade();
            $fin = $fin->getUpgrade($id);
            foreach ($gt as $temp){
                if((int)$temp['GTId'] == (int)$fin['gtid']){
                    $valid = true;
                }
            }
        } else if($controller == 'lte'){
            $gt = new Model_DbTable_Gasturbine();
            $gt = $gt->getGTP($pid);
            $fin = new Model_DbTable_LTE();
            $fin = $fin->getLTE($id);
            foreach ($gt as $temp){
                if((int)$temp['GTId'] == (int)$fin['gtid']){
                    $valid = true;
                }
            }
        }

        if(!$valid){
            //$request->setControllerName('dashboard');
            //$request->setActionName('index');
        }            
    }
}

?>
