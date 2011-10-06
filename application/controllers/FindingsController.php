<?php

class FindingsController extends Zend_Controller_Action {

    public function init() {
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('list', 'json')
                ->initContext();
    }
            
    public function indexAction() 
    {
    	$this->_helper->getHelper('Layout')->disableLayout();
    	$sid = $this->_getParam('id',0);
		$this->view->ssid = $this->_getParam('ssid',0);
    	$subSysModel = new Model_DbTable_Gtsubsystems();
    	$subSysList = $subSysModel->groupSubSystem($sid);
    	$this->view->sslist = $subSysList;
    }

    public function addAction() {
        try {
        	var_dump($this->getRequest()->getPost());
            $gtid['gtid'] = $this->getRequest()->getPost('gtid');
            $this->view->headTitle('Add New Finding', 'PREPEND');
            $form = new Form_GTDataForm();
			$form->showform($gtid['gtid'],0,"finding");
            $form->submit->setLabel('Add');           	
            $this->view->form = $form;
            $sysModel = new Model_DbTable_Gtsystems();
            $this->view->subsystems = $sysModel->fetchAll();
            $form->populate($gtid);
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if (isset($formData['title'])) {
                    if ($form->isValid($formData)) {
                        $userp = new Model_DbTable_Finding();
                        $content = $form->getValues();
						$type = "finding";
						$grpdata = $userp->fetchAll("gtid = " . $gtid['gtid'] . " AND type = '" . $type . "'");
						foreach($grpdata as $data)
						{
							if($data['title'] == $content['title'])
							{
								$this->view->message = ucfirst($type). " title already exists";
								return;
							}
						}
						/*if($content['presentationId'] != "")
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
						if($content['prestitle'] != "" && $content['prestitle'] != NULL)
						{
							$p = $pmodel->insert($data);
							if($temp == "")
							{
								$temp = $p . ",";
							}
							else {
								$temp = $temp . $p . ",";
							}
						}
						$content['presentationId'] = $temp;*/
						if($content['subSysId'] == 0 || $content['subSysId'] == "")
						{
							$content['subSysId'] = 34;
						}
						$inscontent = array(
							'gtid' => $gtid['gtid'],
							'type' => 'finding',
							'data' => $content['data'],
							'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id,
							'title' => $content['title'],
							//'presentationId' => $temp,
							'sysId' => $content['sysId'],
							'subSysId' => $content['subSysId'],
							'EOH' => $content['EOH'],
							'DOF' => $content['DOF'],
							'TOI' => $content['TOI']
							
						);
                        $fid = $userp->add($inscontent);
                        $this->_redirect('/findings/view?id=' . $fid);
                    } else {
                        $form->populate($formData);
                    }
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editAction() {
    	
        $this->view->headTitle('Edit Finding', 'PREPEND');
        try {
        	$id = $this->_getParam('id', 0);
			$gtdatamodel = new Model_DbTable_Gtdata();
			$gtdata = $gtdatamodel->getData($id);
			$gtid = $gtdata['gtid'];
            $form = new Form_GTDataForm();
			$form->showForm($gtid,$id,"finding");
            $form->submit->setLabel('Save');
			
            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                $form->submit->setLabel('Save & Continue');
			}           
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $finding = new Model_DbTable_Finding();
                    $gtdatamodel = new Model_DbTable_Gtdata();
                    $gtdata = $gtdatamodel->getData($id);
                    $content = $form->getValues();
                    /*foreach ($content['presentationId'] as $presentations) {
                        $presid = $presid . $presentations . ",";
                    }
					if ($presid == ',')
					{
						$presid = "";
					}
                    $content['presentationId'] = $presid;*/
					$r = array_diff($content,$gtdata);
					if(count($r) > 0)
					{
						/*$pmodel = new Model_DbTable_Presentation();
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
						if($p != 0)
						{
							$p = $p . ",";
							$temp = $p;
							
							
						}
						else {
							$p = "";
						}
						
						if($presid != "")
						{
							$temp = $presid . $p;
						}

						$gtdatamodel = new Model_DbTable_Gtdata();
						$gtdata = $gtdatamodel->getData($id);
						$temp = $temp . $gtdata['presentationId'];
						
						$content['presentationId'] = $temp;*/
						if($content['subSysId'] == 0 || $content['subSysId'] == "")
						{
							$content['subSysId'] = 34;
						}
						$content = array(
							'id'   => $id,
							'gtid' => $gtdata['gtid'],
							'type' => 'finding',
							'data' => $content['data'],
							'userupdate' => Zend_Auth::getInstance()->getStorage()->read()->id,
							'title' => $content['title'],
							//'presentationId' => $temp,
							'sysId' => $content['sysId'],
							'subSysId' => $content['subSysId'],
							'EOH' => $content['EOH'],
							'DOF' => $content['DOF'],
							'TOI' => $content['TOI']
						);
                    	$finding->updateFinding($content);
                    	$nf = new Model_DbTable_Notification();
                        $formD = $this->_getParam('id', 0);
                        $nf->add($formD, 'finding', 0);
                    }

                    $this->_redirect('/findings/view?id=' . $id);
                    if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                        $this->_redirect('finding/list');
                    }
                } else {
                    $form->populate($formData);
                }
            } else {
                $id = $this->_getParam('id', 0);
                $fin = new Model_DbTable_Finding();
				$fdata = $fin->getFinding($id);
               	$form->populate($fin->getFinding($id));
				$form->subSysId->setValue($fdata['subSysId']);
				$this->view->gtdata = $fin->getFinding($id);
            }
        } catch (exception $e) {
            echo $e;
        }
    }

    public function listAction() {
        if ($this->_request->isXmlHttpRequest()) {
            $this->_helper->getHelper('Layout')->disableLayout();
        }
        $id = $this->_getParam('id', 0);
		
        $resultSet = new Model_DbTable_Finding();
        $resultSet = $resultSet->listFinding($id);
		
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
		
		$gast = $gtmodel->getGT($id);
		$role = Zend_Registry::get("role");
		if((int)$gast['plantId'] == (int)$pid || $role == 'sa')
		{
			$this->view->ubool = true;
		}
		else {
			$this->view->ubool = false;
		}
		
        $this->view->findings = $resultSet;
        $this->view->id = $id;
        $this->view->gt = $gt;
    }

    public function deleteAction() {
        if ($this->getRequest()->isPost()) {
            $del = $this->getRequest()->getPost('del');
            if ($del == 'Delete') {
                $id = $this->getRequest()->getPost('id');
                $user = new Model_DbTable_Finding();
				$gtdatamodel = new Model_DbTable_Gtdata();
				$data = $gtdatamodel->getData($id);
				$gtid = $data['gtid'];
                $user->deleteFinding($id);
				$this->_redirect("/gasturbine/view?id=" .$gtid . "#ui-tabs-2");
				
            }
        }
    }

    public function viewAction() {
        try {
            $id = $this->_getParam('id', 0);
            $result = new Model_DbTable_Finding();
            $result = $result->getFinding($id);
			
            $this->view->headTitle("View Finding - " . $result['title'], 'PREPEND');

            $presentations = new Model_DbTable_Presentation();
			$this->view->presmodel = $presentations;
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
			
            $this->view->finding = $result;
            $this->view->plist = $ptitle;
            $this->view->gt = $gt;
        } catch (Exception $e) {
            echo $e;
        }
    }
    
    
    
    

}