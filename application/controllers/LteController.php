<?php

class LteController extends Zend_Controller_Action {

    public function init() {
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('list', 'json')
                ->initContext();
    }

    public function indexAction() {
    	
	}

    public function addAction() {
        try {
            $this->view->headTitle("Add New LTE", 'PREPEND');
            $gtid['gtid'] = $this->getRequest()->getPost('gtid');
            $form = new Form_GTDataForm();
			$form->showform($gtid['gtid']);
            $form->submit->setLabel('Add');
            $this->view->form = $form;
            $form->populate($gtid);
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if (isset($formData['title'])) {
                    if ($form->isValid($formData)) {
                        $userp = new Model_DbTable_LTE();
                        $content = $form->getValues();
						$type = "lte";
						$grpdata = $userp->fetchAll("gtid = " . $gtid['gtid'] . " AND type = '" . $type . "'");
						foreach($grpdata as $data)
						{
							if($data['title'] == $content['title'])
							{
								$this->view->message = strtoupper($type). " title already exists";
								return;
							}
						}
						if($content['presentationId'] != "")
						{
	                        $temp = '';
	                        foreach ($content['presentationId'] as $pId) {
	                        	if($pId != "")
								{
	                            	$temp = $temp . $pId . ',';
								}
	                        }
	                    }
						$pmodel = new Model_DbTable_Presentation();
						$pres=file_get_contents($form->content->getFileName());
						$funcs = new Model_Functions();
						$filename = $form->content->getFileName();
						$fileext = $funcs->getFileExt($filename);
						if($filename != NULL)
						{
							if(!in_array($fileext,array('pdf','doc','ppt','docx','pptx','xls','xlsx','jpeg','jpg','png','gif')))
							{
								$this->view->message = "File Type Not Allowed";
								return;
							}
						}
						$data = array(
							'title' => $content['prestitle'],
							'GTId' => $gtid['gtid'],
							'content' => $pres,
							'filetype' => $fileext,
							'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id
						);
						$gtpres = $pmodel->fetchAll('GTId = '. $gtid['gtid']);
						$exists = false;
						foreach($gtpres as $gtp)
						{
							if($gtp['title'] == $content['prestitle'])
							{
								$exists = true;
							}
						}
						if($exists)
						{
							$this->view->message = "Presentation title already exists";
							return;
						}
						$p = $pmodel->insert($data);
						if($temp == "")
						{
							$temp = $p . ",";
						}
						else {
							$temp = $temp . $p . ",";
						}
						$content['presentationId'] = $temp;
						$inscontent = array(
							'gtid' => $gtid['gtid'],
							'type' => 'lte',
							'data' => $content['data'],
							'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id,
							'title' => $content['title'],
							'presentationId' => $temp,
							'sysId' => $content['sysId'],
							'subSysId' => $content['subSysId']
						);
                        $userp->add($inscontent);
                        $this->_redirect('/gasturbine/view?id='.$gtid['gtid'].'#ui-tabs-4');
                        //$this->_redirect('index');
                    } else {
                        $form->populate($formData);
                    }
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function listAction() {
        try {
            if ($this->_request->isXmlHttpRequest()) {
                $this->_helper->getHelper('Layout')->disableLayout();
            }
            $this->view->headTitle("LTE List", 'PREPEND');

            $id = $this->_getParam('id', 0);
            $resultSet = new Model_DbTable_LTE();
            $resultSet = $resultSet->listLTE($id);
            
            $uModel = new Model_DbTable_User();
			$this->view->usermodel = $uModel;
			
			$userModel = new Model_DbTable_Userprofile();
			$this->view->umodel = $userModel;
			
			$sModel = new Model_DbTable_Gtsystems();
			$this->view->sysModel = $sModel;
			
			$ssModel = new Model_DbTable_Gtsubsystems();
			$this->view->subSysModel = $ssModel;
        
            $up = new Model_DbTable_Userprofile();
	        $up = $up->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
	        $pid = $up['plantId'];
	        $gtmodel = new Model_DbTable_Gasturbine();
	        $gt = $gtmodel->getGTP($pid);
	        $this->view->gt = $gt;
	        
			$gast = $gtmodel->getGT($id);
			$role = Zend_Registry::get("role");
			if((int)$gast['plantId'] == (int)$pid || $role == 'sa')
			{
				$this->view->ubool = true;
			}
			else {
				$this->view->ubool = false;
			}

            $this->view->ltes = $resultSet;
            $this->view->id = $id;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Delete') {
                $id = $this->getRequest()->getPost('id');
                $user = new Model_DbTable_LTE();
                $user->deleteLTE($id);
            }
            $this->_helper->redirector('index');
        }
    }

    public function editAction() {
        $this->view->headTitle('Edit LTE', 'PREPEND');
        try {
            $id = $this->_getParam('id', 0);
			$gtdatamodel = new Model_DbTable_Gtdata();
			$gtdata = $gtdatamodel->getData($id);
			$gtid = $gtdata['gtid'];
            $form = new Form_GTDataForm();
			$form->showForm($gtid);
            $form->submit->setLabel('Save');
            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                $form->submit->setLabel('Save & Continue');
            }
            $this->view->form = $form;

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $lte = new Model_DbTable_LTE();

                    $id = $this->_getParam('id',0);
                    $gtdatamodel = new Model_DbTable_Gtdata();
                    $gtdata = $gtdatamodel->getData($id);
                    $content = $form->getValues();
                    
                    foreach($content['presentationId'] as $presentations) {
                    	$presid = $presid . $presentations .",";
                    }
                    $content['presentationId'] = $presid;
                    
                    $r = array_diff($content,$gtdata);
					if(count($r) > 0)
					{
						$pmodel = new Model_DbTable_Presentation();
						$pres=file_get_contents($form->content->getFileName());
						$funcs = new Model_Functions();
						$filename = $form->content->getFileName();
						$fileext = $funcs->getFileExt($filename);
						if($filename != NULL)
						{
							if(!in_array($fileext,array('pdf','doc','ppt','docx','pptx','xls','xlsx','jpeg','jpg','png','gif')))
							{
								$this->view->message = "File Type Not Allowed";
								return;
							}
						}
						$p=0;
						if($content['prestitle'] != "")
						{
							$data = array(
								'title' => $content['prestitle'],
								'GTId' => $gtdata['gtid'],
								'content' => $pres,
								'filetype' => $fileext,
								'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id
							);
							$gtpres = $pmodel->fetchAll('GTId = '. $gtdata['gtid']);
							$exists = false;
							foreach($gtpres as $gtp)
							{
								if($gtp['title'] == $content['prestitle'])
								{
									$exists = true;
								}
							}
							if($exists)
							{
								$this->view->message = "Presentation title already exists";
								return;
							}
							$p = $pmodel->insert($data);	
						}
						if($p != 0 || $p != "") 
						{
							$p = $p . ",";
						}
						if($presid == "")
						{
							$temp = $p;
						}
						else {
							$temp = $presid . $p;
						}
						if($temp == "")
						{
							$gtdatamodel = new Model_DbTable_Gtdata();
							$gtdata = $gtdatamodel->getData($id);
							$temp = $gtdata['presentationId'];
						}
						$content['presentationId'] = $temp;
						$content = array(
							'id'   => $id,
							'gtid' => $gtdata['gtid'],
							'type' => 'lte',
							'data' => $content['data'],
							'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id,
							'title' => $content['title'],
							'presentationId' => $temp,
							'sysId' => $content['sysId'],
							'subSysId' => $content['subSysId']
						);
                    	$lte->updateLTE($content);
                    	$nf = new Model_DbTable_Notification();
                        $formD = $this->_getParam('id', 0);
                        $nf->add($formD, 'lte', 0);
                    }
                    $this->_redirect('/lte/view?id=' . $id);
                    if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                        $this->_redirect('lte/list');
                    }
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                $fin = new Model_DbTable_LTE();
                $form->populate($fin->getLTE($id));
            }
        } catch (exception $e) {
            echo $e;
        }
    }

    public function viewAction() {
        try {
            $id = $this->_getParam('id', 0);
            $result = new Model_DbTable_LTE();
            $result = $result->getLTE($id);

            $this->view->headTitle("View LTE - " . $result['title'], 'PREPEND');

            $presentations = new Model_DbTable_Presentation();
            $plist = explode(',', $result['presentationId']);
            array_pop(&$plist);

            $ptitle = array();
            foreach ($plist as $pid) {
                $res = $presentations->getPresentation($pid);
                $temp = array();
                $temp[] = array_combine(array($res['presentationId']), array($res['title']));
                ;

                $ptitle = array_merge($ptitle, $temp); //array($res['presentationId'] => $res['title']));
            }

            $gt = new Model_DbTable_Gasturbine();
            $gt = $gt->getGT($result['gtid']);
            
			$sModel = new Model_DbTable_Gtsystems();
			$this->view->sysModel = $sModel;
			
			$ssModel = new Model_DbTable_Gtsubsystems();
			$this->view->subSysModel = $ssModel;
            
            $this->view->gt = $gt;
            $this->view->lte = $result;
            $this->view->plist = $ptitle;
        } catch (Exception $e) {
            echo $e;
        }
    }

}
