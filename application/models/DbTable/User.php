<?php

class Model_DbTable_User extends Zend_Db_Table_Abstract {

    protected $_name = 'users';

    public function getUser($id) {
        try {


            $id = (int) $id;
            $row = $this->fetchRow('id = ' . $id);

            if (!$row) {
                throw new Exception("Could not find row $id");
            }
        } catch (Exception $e) {
            echo $e;
        }
        return array('id' => $row->id, 'username' => $row->username, 'password' => $row->password, 'role' => $row->role, 'lastlogin' => $row->lastlogin);
    }
	
	public function getUserByName($uname)
	{
		$row = $this->fetchRow("username = '" . $uname . "'");
		return $row->toArray();
	}

    public static function getListOfUsers() {

        try {
            $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
            $stmt = $dbAdapter->query('SELECT u.id,u.username,u.role,up.firstName,up.lastName,p.plantName FROM users u,userprofile up,plants p ' .
                            'WHERE u.role not like \'sa\' AND u.id = up.id AND up.plantId = p.plantId group by up.plantId');
            $row = $stmt->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function getUsersList($plantId) {
        try {
            $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
            $stmt = $dbAdapter->query("SELECT u.id,u.username,u.role,up.firstName,up.lastName FROM users u,userprofile up,plants " .
                            "WHERE plants.plantId='$plantId' AND plants.plantId = up.plantId AND u.id = up.id");
            $row = $stmt->fetchAll();
            return $row;
        } catch (Exception $e) {
            echo $e;
        }
    }

    public static function generateRandom($size) {
        $arr = '';
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        for ($i = 0; $i < $size; $i++) {
            $r = rand(0, 62);
            $arr = $arr . $chars[$r];
        }
        return $arr;
    }

    public function createAccount($username, $role, $plantId) {
        $password = Model_DbTable_User::generateRandom(8);
        $data = array(
            'username' => $username,
            'password' => $password,
            'role' => $role,
        );
        $id = $this->insert($data);
        $content = array('plantId' => $plantId);

        //adding users to forum

        global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template;
        define('IN_PHPBB', true);
        define('PHPBB_INSTALLED', true);
        $phpbb_root_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $phpbb_root_path = substr($phpbb_root_path, 0, strlen($phpbb_root_path) - 27);
        $phpbb_root_path = $phpbb_root_path . "public" . DIRECTORY_SEPARATOR . "forums" . DIRECTORY_SEPARATOR;
        include($phpbb_root_path . 'common.php');
        include($phpbb_root_path . 'includes/functions_user.php');
        $data = array(
            'user_id' => $id,
            'user_type' => 0,
            'group_id' => 2,
            'username' => $username,
            'user_password' => md5($password)
        );

        user_add($data);
        //-------//

        return $id;
    }

    public function resetPassword($id) {
        try {
            $upModel = new Model_DbTable_Userprofile();
            $user = $upModel->getUser($id);
            $rpassword = Model_DbTable_User::generateRandom(8);

            $mailbody = "<div style='width: 100%; '><div style='border-bottom: solid 1px #aaa; margin-bottom: 10px;'>";
            $mailbody = $mailbody . "<a href='http://www.hiveusers.com' style='text-decoration: none;'><span style='font-size: 34px; color: #2e4e68;'><b>hive</b></span>";
            $mailbody = $mailbody . "<span style='font-size: 26px; color: #83ac52; text-decoration:none;'><b>users.com</b></span></a><br/><br/>Password Reset</div>";
            $mailbody = $mailbody . "<div style='margin-bottom:10px;'><span style='color: #000;'><i>Hello</i>,<br/><br/>Your Password has been Reset to <b>" . $rpassword ."</b></span></div>";
            $mailbody = $mailbody . "<div style='border-top: solid 1px #aaa; color:#aaa; padding: 5px;'><center>This is a generated mail, please do not Reply.</center></div></div>";

            $mcon = Zend_Registry::get('mailconfig');
			$config = array('ssl' => $mcon['ssl'], 'port' => $mcon['port'], 'auth' => $mcon['auth'], 'username' => $mcon['username'], 'password' => $mcon['password']);
			$tr = new Zend_Mail_Transport_Smtp($mcon['smtp'],$config);
			Zend_Mail::setDefaultTransport($tr);
	        $mail = new Zend_Mail();
	        $mail->setBodyHtml($mailbody);
	        $mail->setFrom($mcon['fromadd'], $mcon['fromname']);
			
            $where = $this->getAdapter()->quoteInto('id = ?', $id);
            $rowaffected = $this->update(array('password' => md5($rpassword . "{" . $id . "}")), array($where));
			$data['user_password'] = md5($rpassword);
            $whereClause['user_id = ?'] = $id;
            $forumUserModel = new Model_DbTable_Forum_Users();
            $forumUserModel->update($data, $whereClause);
			
			
            return array('rowsAffected' => $rowaffected, 'password' => $rpassword);
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function deleteAccount($id) {
        $this->delete('id =' . (int) $id);
        $userProfileModel = new Model_DbTable_Userprofile();
        $userProfileModel->delete('id=' . (int) $id);
        //delete user from forum also

        global $phpbb_root_path, $phpEx, $user, $db, $config, $cache, $template;
        define('IN_PHPBB', true);
        define('PHPBB_INSTALLED', true);
        $phpbb_root_path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        $phpbb_root_path = substr($phpbb_root_path, 0, strlen($phpbb_root_path) - 27);
        $phpbb_root_path = $phpbb_root_path . "public" . DIRECTORY_SEPARATOR . "forums" . DIRECTORY_SEPARATOR;
        include($phpbb_root_path . 'common.php');
        include($phpbb_root_path . '/includes/functions_user.php');
        user_delete("remove", $id);

        //-----//
    }

    public function changePassword($id, $oldPassword, $newPassword) {
        try {
            $checkid = $this->getAdapter()->quoteInto('id = ?', $id);
            $checkpass = $this->getAdapter()->quoteInto('password = ?', md5($oldPassword . "{" . $id . "}"));
            $row = $this->fetchAll(array($checkid, $checkpass))->toArray();

            //change forum password
            $data['user_password'] = md5($newPassword);
            $where['user_id = ?'] = $id;
            $forumUserModel = new Model_DbTable_Forum_Users();
            $forumUserModel->update($data, $where);
            //-----//

            return $this->update(array('password' => md5($newPassword . "{" . $id . "}")), array($checkid, $checkpass));
        } catch (Exception $e) {
            echo $e;
        }
    }

    public function timeStamp($id) {
        $time = date('Y-m-d H:i:s');
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update(array('lastlogin' => $time), array($where));
    }

    public function is_confchair($id) {
        $id = (int) $id;
        $rSet = $this->fetchRow('id = ' . $id);
        $rSet->toArray();
        return $rSet['conf_chair'];
    }

    public function ccinfo() {
        $rSet = $this->fetchRow('conf_chair = 1');
        if (count($rSet) != 0) {
            return $rSet['id'];
        } else {
            return 0;
        }
    }

    public function setcc($id) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update(array('conf_chair' => 1), array($where));
    }

    public function unsetcc($id) {
        $where = $this->getAdapter()->quoteInto('id = ?', $id);
        $this->update(array('conf_chair' => 0), array($where));
    }
	

}