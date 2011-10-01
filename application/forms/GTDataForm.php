<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Form_GTDataForm extends Zend_Form {

		public function showform($gturbineid)    
		{
	        $this->setName('GTData');
	
	        $pObj = new Model_DbTable_Presentation();
	        $presentationValue = $pObj->fetchAll("GTId = " . $gturbineid);
	
	        $data = array();
	        $data[''] = 'Select an Option';
	        foreach ($presentationValue as $pl) {
	            $data[$pl->presentationId] = $pl->title;
	        }
			
			$sysModel = new Model_DbTable_Gtsystems();
			$system = $sysModel->fetchAll();
			$sysSubModel = new Model_DbTable_Gtsubsystems();
			$subsystem = $sysSubModel->fetchAll();
			$sysNames = array();
			$sysNames[''] = 'Select an Option';
			foreach($system as $list)
			{
				$sysNames[$list['sysId']] = $list['sysName']; 
			}
			foreach($subsystem as $slist)
			{
				$sysSubNames[$slist['id']] = $slist['subSysName'];
			}
			
			$sys = new Zend_Form_Element_Select('sysId');
			$sys->setLabel('System Name')
				->addMultiOptions($sysNames)
				->addDecorator('Htmltag', array('tag' => 'br'))
	            ->setRequired(true)
	            ->addFilter('StripTags')
	            ->addFilter('StringTrim')
	            ->addValidator('NotEmpty');
	            
	       	$subsys = new Zend_Form_Element_Select('subSysId');
			$subsys->setLabel('Sub System Name')
				->addMultiOptions($sysSubNames)
				->addDecorator('Htmltag', array('tag' => 'br'))
	            ->setRequired(true)
	            ->addFilter('StripTags')
	            ->addFilter('StringTrim')
	            ->addValidator('NotEmpty');
	       
	       	$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
			
			$prestitle = new Zend_Form_Element_Text('prestitle');
	        $prestitle->setLabel('Presentation Title')
			->addDecorator('Htmltag', array('tag' => 'br'))
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());
			
	        $content=new Zend_Form_Element_File('content');
	        $content->setLabel('Upload the Presentation')
	                ->setDestination($appath . '/public/uploads')
	                ->addDecorator('Htmltag',array('tag' => 'br'));
			
			$info= new Zend_Form_Element_Hidden('info');
    		$info->setLabel("(allowed formats - pdf,ppt,pptx,xls,xlsx,doc,docx,jpg,jpeg,png,gif)");
			
	        $pid = new Zend_Form_Element_Multiselect('presentationId');
	        $pid->setLabel('Or Choose an Existing Presentation')
	                ->addMultiOptions($data)
	                ->addDecorator('Htmltag', array('tag' => 'br'))
	                ->addFilter('StripTags')
	                ->addFilter('StringTrim');                
				
	
	        $gtid = new Zend_Form_Element_Hidden('gtid');
	        $gtid->setAttrib('value', 'TESTING');
	
	        $id = new Zend_Form_Element_Hidden('id');
	        $id->setAttrib('id', $this->getId());
	
	        $Title = new Zend_Form_Element_Text('title');
	        $Title->setLabel('Title')
	                ->setRequired(true)
	                ->addDecorator('Htmltag', array('tag' => 'br'))
	                ->addValidator('NotEmpty')
	                ->addFilter('StripTags')
	                ->addFilter('StringTrim')
	                ->addValidator(Model_Validators::alnum());
	
	
	        $Data = new Zend_Form_Element_Textarea('data');
	        $Data->setLabel('Data')
	                ->setRequired(true)
	                ->addDecorator('Htmltag', array('tag' => 'br'))
	                ->addValidator('NotEmpty')
	                ->addFilter('StringTrim');
	
	        $submit = new Zend_Form_Element_Button('submit');
	        $submit->addDecorator('Htmltag', array('tag' => 'p'));
	        $submit->setAttrib('id', 'submitbutton')
					->setAttrib('class','gt-add')
	                ->setAttrib('type', 'submit');
	        
	        $this->addElements(array($id,$gtid,$sys,$subsys,$prestitle,$content,$info,$pid, $Title, $Data, $submit));
	        
    }

}

?>
