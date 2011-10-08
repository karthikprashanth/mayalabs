<?php

class PlantController extends Zend_Controller_Action {

    public function init() {
        
    }

    public function indexAction() {
        try {
            $up = new Model_DbTable_Userprofile();
            $up = $up->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
            $pid = $up['plantId'];
            $this->_redirect("/plant/view?id=$pid");
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function addAction() {
        try {
            $this->view->headTitle('Add Plant', 'PREPEND');
            $form = new Form_PlantForm();
            $form->setMode("add");
            $form->showForm();
            $form->partPlant3->submit->setLabel('Add');
            //JQuery Form Enable
            ZendX_JQuery::enableForm($form);
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $userp = new Model_DbTable_Plant();
                    $content = $form->getValues();
                    $content = array_merge($content['partPlant1'], $content['partPlant2'], $content['partPlant3']);
                    $grplant = $userp->fetchAll();
                    $corp = false;
                    foreach ($grplant as $g) {
                        if ($g['corporateName'] == $content['corporateName']) {
                            $corp = true;
                        }
                    }
                    if ($corp) {
                        $grplant = $userp->fetchAll("corporateName = '" . $content['corporateName'] . "'");
                        foreach ($grplant as $c) {
                            if ($c['plantName'] == $content['plantName']) {
                                $this->view->message = "Plant name already exists";
                                return;
                            }
                        }
                    }
                    $plantid = $userp->add($content);
                    $myuser = Zend_Auth::getInstance()->getStorage()->read()->id;
                    Zend_Registry::set('id', $myuser);
                    $this->_redirect('plant/view?id=' . $plantid);
                } else {
                    $form->populate($formData);
                }
            }
        } catch (Exception $e) {

            echo $e;
        }
    }

    public function viewAction() {
        try {
            $role = Zend_Registry::get('role');
            $id = $this->_getParam('id');
            $PView = new Model_DbTable_Plant();
            $PData = $PView->getPlant($id);
            $this->view->id = $id;
            $this->view->headTitle("View Plant - " . $GTData['corporateName'], 'PREPEND');

            $this->view->plantData = $PData;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editAction() {
        $this->view->headTitle('Edit Plant', 'PREPEND');
        try {

            $form = new Form_PlantForm();
            $form->setMode("edit");
            $form->showForm();
            //JQuery Form Enable
            ZendX_JQuery::enableForm($form);
            $form->partPlant3->submit->setLabel('Save');
            $form->partPlant3->submit->setAttrib('class', 'user-save');

            $this->view->form = $form;
            $this->view->plantId = $this->_getParam('id', 0);

            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $GT = new Model_DbTable_Plant();
                    $plantDet = $GT->getPlant($this->_getParam('id', 0));
                    $plantId = $this->_getParam('id', 0);
                    $this->view->plantId = $plantId;
                    $content = array_merge($form->partPlant1->getValues(), $form->partPlant2->getValues(), $form->partPlant3->getValues());
                    if (count(array_diff($content, $plantDet)) > 0) {
                        $nf = new Model_DbTable_Notification();
                        $nf->add($plantId, 'plant', 0);
                        $GT->updatePlant($plantId, $content);
                    }
                    if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                        $this->_redirect('gasturbine/plantlist');
                    }
                    if ($this->getRequest()->getPost("modeselect") == "redirect") {
                        $this->_redirect('plant/view?id=' . $plantId);
                    }
                    if ($this->getRequest()->getPost("modeselect") == "stay1") {
                        $this->_redirect('plant/edit?id=' . $plantId . '#tabContainer-frag-1');
                    }
                    if ($this->getRequest()->getPost("modeselect") == "stay2") {
                        $this->_redirect('plant/edit?id=' . $plantId . '#tabContainer-frag-2');
                    }
                    if ($this->getRequest()->getPost("modeselect") == "stay3") {
                        $this->_redirect('plant/edit?id=' . $plantId . '#tabContainer-frag-3');
                    }
                } else {
                    $form->populate($formData);
                }
            } else {
                $plantId = $this->_getParam('id', 0);
                $PlantVal = new Model_DbTable_Plant();
                $form->populate($PlantVal->getPlant($plantId));
            }
        } catch (exception $e) {
            echo $e;
        }
    }

    public function listAction() {
        try {
            $role = Zend_Registry::get('role');

            $this->view->headTitle('List Plants', 'PREPEND');
            $resultSet = new Model_DbTable_Plant();
            $resultSet = $resultSet->listPlants();

            $up = new Model_DbTable_Userprofile();
            $up = $up->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
            $pid = $up['plantId'];

            $Pdata = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($resultSet));
            $Pdata->setItemCountPerPage(5)
                    ->setCurrentPageNumber($this->_getParam('page', 1));

            $this->view->Pdata = $Pdata;
            $this->view->pid = $pid;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function adminAction() {
        try {
            $resultSet = new Model_DbTable_Plant();
            $resultSet = $resultSet->listPlants();

            $plants = new Zend_Paginator(new Zend_Paginator_Adapter_DbSelect($resultSet));
            $plants->setItemCountPerPage(5)
                    ->setCurrentPageNumber($this->_getParam('page', 1));

            $this->view->plants = $plants;
        } catch (Exception $exc) {
            echo $exc;
        }
    }

    public function editvalidateAction() {
        try {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->getHelper('layout')->disableLayout();
            $form = new Form_PlantForm();
            $formData = $this->getRequest()->getPost();
            $form->isValid($formData);
            $json = $form->getMessages();
            echo Zend_Json::encode($json);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function addvalidateAction() {
        try {
            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->getHelper('layout')->disableLayout();
            $form = new Form_PlantForm();
            $formData = $this->getRequest()->getPost();
            $form->isValid($formData);
            $json = $form->partPlant1->getMessages();
            $json = array_merge($json, $form->partPlant2->getMessages());
            $json = array_merge($json, $form->partPlant3->getMessages());
            echo Zend_Json::encode($json);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function clistAction() {
        $pmodel = new Model_DbTable_Plant();
        $pdet = $pmodel->getPlantList();
        $this->view->pdet = $pdet;
    }

    public function resultsAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $term = $this->_getParam('term');
        $ll = $this->_getParam('ll');
        $ul = $this->_getParam('ul');
        $pmodel = new Model_DbTable_Plant();
        $results = $pmodel->getSearchResults($term);
        $this->view->term = $term;
        if ($term == NULL) {
            $select = $pmodel->select()->order('plantName');
            $results = $pmodel->getAllPlants();
        }
        $this->view->results = $results;
        $this->view->resultcount = $pmodel->getCount();
        $umodel = new Model_DbTable_Userprofile();
        $this->view->usermodel = $umodel;
        $this->view->ll = $ll;
        $this->view->ul = $ul;
    }

}

