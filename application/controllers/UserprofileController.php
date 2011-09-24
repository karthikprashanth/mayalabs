<?php

class UserprofileController extends Zend_Controller_Action {

    public function init() {
        $contextSwitch = $this->_helper->getHelper('contextSwitch');
        $contextSwitch->addActionContext('changepassword', 'json')
                ->initContext();
    }

    public function indexAction() {
        $this->view->headTitle('Edit User', 'PREPEND');
        try {
            $form = new Form_UserprofileForm();
            $form->submit->setLabel('Save');
            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                $form->submit->setLabel('Save & Continue');
            }
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $userup = new Model_DbTable_Userprofile();
					
                    $content = $form->getValues();
					
                    $id = Zend_Auth::getInstance()->getStorage()->read()->id;
					$user = $userup->getUser($id);
					$pid = $user['plantId'];                    
                    $userup->updateUser($id, $content);
                    if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                        if (Zend_Auth::getInstance()->getStorage()->read()->role != 'us')
                            $this->_redirect('plant/edit?id='.$pid);
                    }
                    $this->_helper->redirector('view');
                }
                else {
                    $form->populate($formData);
                }
            } else {
                $myUser = Zend_Auth::getInstance()->getStorage()->read()->id;
                $user = new Model_DbTable_Userprofile();
                $form->populate($user->getUser($myUser));
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function addAction() {
        $this->view->headTitle('Add User', 'PREPEND');
        try {
            $form = new Form_UserprofileForm();
            $form->submit->setLabel('Add');
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
					
                    $userp = new Model_DbTable_Userprofile();
                    $id = $this->_getParam('id');
                    $content = $form->getValues();
                   	$users = $userp->fetchAll();
					$exists = false;
					foreach($users as $user)
					{
						if($user['email'] == $content['email'])
						{
							$exists = true;
						}
					}
					if($exists)
					{
						$this->view->message = "Email already belongs to another user";
						return;
					}
					$userp->add($id, $content);
                    $this->_redirect('/userprofile/view?id='.$id);
                } else {
                    $form->populate($formData);
                }
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editAction() {
        $this->view->headTitle('Edit User', 'PREPEND');
        try {
            $form = new Form_UserprofileForm();
            $form->submit->setLabel('Save');
            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                $form->submit->setLabel('Save & Continue');
            }
            $this->view->form = $form;
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $userup = new Model_DbTable_Userprofile();
                    $content = $form->getValues();

                    $id = Zend_Auth::getInstance()->getStorage()->read()->id;                    
                    $userup->updateUser($id, $content);
                    if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                        /*if (Zend_Auth::getInstance()->getStorage()->read()->role != 'us')
                            $this->_redirect('plant/edit');*/
                        $ses = new Zend_Session_Namespace('Zend_Auth');
                        $ses->storage->lastlogin = $d = date('Y-m-d H:i:s');
                        $this->_redirect('dashboard/index');
                    }
                    $this->_helper->redirector('view');
                }
                else {
                    $form->populate($formData);
                }
            } else {
                $myUser = Zend_Auth::getInstance()->getStorage()->read()->id;
                $user = new Model_DbTable_Userprofile();
                $form->populate($user->getUser($myUser));
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function viewAction() {
        try {
        	if($this->_getParam('id') != 0) {
        		$myUser = $this->_getParam('id');
        	}
        	else {
	            $role = Zend_Registry::get('role');
	            $myUser = Zend_Auth::getInstance()->getStorage()->read()->id;
	        }
            $userView = new Model_DbTable_Userprofile();
            $profileData = $userView->getUser($myUser);
			$pmodel = new Model_DbTable_Plant();
			$plant = $pmodel->getPlant($profileData['plantId']);
			$this->view->uPlantName = $plant['plantName'];
            $this->view->headTitle('View User - ' . $profileData['firstName'] . ' ' . $profileData['lastName'], 'PREPEND');

            $this->view->profileData = $profileData;
			
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function changepasswordAction() {

        $this->view->headTitle('Change Password', 'PREPEND');
        try {
            $form = new Form_ChangePasswordForm();
            $form->submit->setLabel('Change Password');
            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '') {
                $form->submit->setLabel('Save & Continue');
            }
            $this->view->message = "Not yet posted";
            if ($this->getRequest()->isPost()) {
                $formData = $this->getRequest()->getPost();
                if ($form->isValid($formData)) {
                    $userPass = new Model_DbTable_User();
                    $content = $form->getValues();
                    $id = Zend_Auth::getInstance()->getStorage()->read()->id;
                    $oldPassword = $form->getValue('oldPassword');
                    $newPassword = $form->getValue('newPassword');
                    $reNewPassword = $form->getValue('reNewPassword');
                    if ($newPassword == $reNewPassword) {
                        $statusPass = $userPass->changePassword($id, $oldPassword, $newPassword);
                        if ($statusPass == 1) {
                            $this->view->message = 'Password has been changed';
							
							//Send Mail
							
							$umodel = new Model_DbTable_Userprofile();
							$user = $umodel->getUser($id);
							$mailbody = "<div style='width: 100%; '><div style='border-bottom: solid 1px #aaa; margin-bottom: 10px;'>";
					        $mailbody = $mailbody . "<a href='http://www.hiveusers.com' style='text-decoration: none;'><span style='font-size: 34px; color: #2e4e68;'><b>hive</b></span>";
					        $mailbody = $mailbody . "<span style='font-size: 26px; color: #83ac52; text-decoration:none;'><b>users.com</b></span></a><br/><br/>Password Changed Successfully</div>";
					        $mailbody = $mailbody . "<div style='margin-bottom:10px;'><span style='color: #000;'><i>Hello " . $user['firstName'] . "</i>,<br/><br/>Your password has been changed successfully <br/><br/>Please click <a href = 'http://www.hiveusers.com/userprofile/view' style = 'text-decoration:none;'> <b>here<b> </a> to view your profile.</span>";	
							$mailbody = $mailbody . "</div><div style='border-top: solid 1px #aaa; color:#aaa; padding: 5px;'><center>This is a generated mail, please do not Reply.</center></div></div>";
							$mcon = Zend_Registry::get('mailconfig');
							$config = array('ssl' => $mcon['ssl'], 'port' => $mcon['port'], 'auth' => $mcon['auth'], 'username' => $mcon['username'], 'password' => $mcon['password']);
							$tr = new Zend_Mail_Transport_Smtp($mcon['smtp'],$config);
							Zend_Mail::setDefaultTransport($tr);
					        $mail = new Zend_Mail();
					        $mail->setBodyHtml($mailbody);
					        $mail->setFrom($mcon['fromadd'], $mcon['fromname']);
					        $mail->addTo($user['email'], $user['firstName']);
					        $mail->setSubject('Password Changed Successfully');
					        $mail->send();
							$this->_redirect("userprofile/index");
							
							//----//
							
                            if (Zend_Auth::getInstance()->getStorage()->read()->lastlogin == '')
                                $this->_redirect('userprofile/index');
                        } else
                            $this->view->message = 'Wrong Password';
                    }
                    else {
                        $this->view->message = 'New password and Confirm Password do no match';
                    }
                } else {
                    $form->populate($formData);
                }
            }


            $this->view->form = $form;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function editvalidateAction() {
        try {

            $this->_helper->viewRenderer->setNoRender();
            $this->_helper->getHelper('layout')->disableLayout();

            $form = new Form_UserprofileForm();
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
            $form = new Form_UserprofileForm();
            $formData = $this->getRequest()->getPost();
            $form->isValid($formData);
            $json = $form->getMessages();
            echo Zend_Json::encode($json);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function displaynameAction() {
        try {
            if(!$this->_request->isXmlHttpRequest())
                $this->_helper->viewRenderer->setResponseSegment('displayname');
            $up = new Model_DbTable_Userprofile();
            $up = $up->getUser(Zend_Auth::getInstance()->getStorage()->read()->id);
            $name = $up['firstName'] . " " . $up['lastName'];
            $this->view->name = $name;
        } catch (Exception $e) {
            echo $e;
        }
    }

}
