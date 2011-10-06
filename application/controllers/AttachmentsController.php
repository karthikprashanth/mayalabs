<?php

class AttachmentsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    }
	
	public function addAction()
	{
		$this->_helper->getHelper('Layout')->disableLayout();
		$form = new Form_AttachmentsForm();
		$this->view->form = $form;
	}
	
	public function uploadAction()
	{
		$this->_helper->getHelper('Layout')->disableLayout();
		$title = $this->getRequest()->getPost("title");
		$filename =  $this->getRequest()->getPost("filename");
		$i=0;
		$cnt=1;
		for($i=0;$i<strlen($filename);$i++)
		{
			if(ord(substr($filename,$i,1)) == 47 || ord(substr($filename,$i,1)) == 92)
			{
				$cnt = $i;
			}
		}
		$cnt++;
		$filename = substr($filename,$cnt,strlen($filename));
		$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
		//echo $appath . "<br>";
		//$filepath = $appath . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "uploads" . DIRECTORY_SEPARATOR . $filename;
		$filepath = "/var/www/hive/public/uploads/TranscodedWallpaper.jpg";
		echo $filepath . "<br>";
		$data = file_get_contents($filepath);
		var_dump($data);
		
	}

}



