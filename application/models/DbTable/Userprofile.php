<?php

class Model_DbTable_Userprofile extends Zend_Db_Table_Abstract {

    protected $_name = 'userprofile';

    public function getUser($id) {
        $id = (int) $id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function add($id, $content) {
        try {
            $content = array_merge($content, array('id' => $id));
            $pmodel = new Model_DbTable_Plant();
            $plant = $pmodel->getPlant($content['plantid']);
            $content = array_merge($content, array('corporateName' => $plant['corporateName'], 'plantName' => $plant['plantName']));
            $this->insert($content);
            $forumUserModel = new Model_DbTable_Forum_Users();
            $forumUserModel->updateEmail($id, $content['email']);
			$forumwhere['user_id = ?'] = $id;
			$forumcontent = array('user_plantname' => $plant['plantName'],'user_fullname' => $content['firstName'] . " " . $content['lastName']);
			$forumUserModel->update($forumcontent,$forumwhere);
            $where['id = ?'] = $id;
            $uModel = new Model_DbTable_User();
            $user = $uModel->getUser($id);
            $pwd = $user['password'];
            $data = array('password' => md5($pwd . "{" . $id . "}"));
            $uModel->update($data, $where);
            
            $mailbody = "<div style='width: 100%; '><div style='margin-bottom: 10px; border-bottom: solid 1px #000;'>";
            $mailbody = $mailbody . "<a href='http://www.hiveusers.com' style='text-decoration: none;'><span style='font-size: 34px; color: #2e4e68;'><b>hive</b></span>";
            $mailbody = $mailbody . "<span style='font-size: 26px; color: #83ac52; text-decoration:none;'><b>users.com</b></span></a><br/><br/>";
            $mailbody = $mailbody . "Welcome to Hive</div>";
            
            $mailbody = $mailbody . "<p style='color: #000;'>With the changing business environment and a growing need to share information, connectivity has become one of the most integral aspect of a company's success.</p>
                                     <p style='color: #000;'><a href='http://hiveusers.com/' style='text-decoration:none; color: #2e4e68;'><b>Hive</b></a><span style='color: #000;'> is a customized web based networking solution that empowers individuals, groups and corporates to connect and share information with one another. It has been built
                                     keeping in mind the needs and requirements of the power sector. Featuring a powerful yet userfriendly interface, it boasts a dynamic range of features.</span></p>";

            $mailbody = $mailbody . "<ul style='color:#2e4e68;'><li>Customised Search Matrix</li><li>Article and Presentation Inventory</li><li>User Group Meeting Coverage</li><li>Discussion Forums</li><li>Quarterly Newsletter</li><li>Email Notification</li></ul>";
            
            $mailbody = $mailbody . "<p>To see more of what hive can do for you, login using the following credentials: <br/><br/>";
            $mailbody = $mailbody . "<b>Username : </b>" . $user['username'] . "<br/>";
            $mailbody = $mailbody . "<b>Password : </b>" . $pwd . "<br/></p><br/>Regards,<br/>Hive Team<br/>";
            
            $mailbody = $mailbody . "<div style='border-top: solid 1px #000; color:#aaa; padding: 5px;'><center>This is a generated mail, please do not Reply.</center></div></div>";

            $mcon = Zend_Registry::get('mailconfig');
			$config = array('ssl' => $mcon['ssl'], 'port' => $mcon['port'], 'auth' => $mcon['auth'], 'username' => $mcon['username'], 'password' => $mcon['password']);
			$tr = new Zend_Mail_Transport_Smtp($mcon['smtp'],$config);
			Zend_Mail::setDefaultTransport($tr);
	        $mail = new Zend_Mail();
	        $mail->setBodyHtml($mailbody);
	        $mail->setFrom($mcon['fromadd'], $mcon['fromname']);
            $mail->setSubject('Account Information');
            $mail->send();
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function updatePlantId($id, $plantid) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update(array('plantId' => $plantid), $where);
    }

    public function updateUser($id, $content) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update($content, $where);
		$forumUserModel = new Model_DbTable_Forum_Users();
		$forumwhere['user_id = ?'] = $id;
		$forumcontent = array('user_fullname' => $content['firstName'] . " " . $content['lastName']);
		$forumUserModel->update($forumcontent,$forumwhere);
		
    }

    public function getUserList($pid) {
        $pid = (int) $pid;
        $row = $this->fetchAll('plantId = ' . $pid);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

}