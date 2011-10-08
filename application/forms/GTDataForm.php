<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Form_GTDataForm extends Zend_Form {

		public function showform($gturbineid,$gtdataid,$gtdatatype)    
		{
	        $this->setName('GTData');

	        $pObj = new Model_DbTable_Presentation();
	        $presentationValue = $pObj->fetchAll("GTId = " . $gturbineid);

	        $data = array();
	        $data[''] = 'Select an Option';
			if($gtdatatype == 'finding')
			{
				$doflabel = "Finding";
			}
			else
			{
				$doflabel = "Implementation";
			}
			if($gtdataid == 0)
			{
		        foreach ($presentationValue as $pl) {
		            $data[$pl->presentationId] = $pl->title;
		        }
			}
			else {
				$gtdatamodel = new Model_DbTable_Gtdata();
				$gtdata = $gtdatamodel->getData($gtdataid);

				$presid = explode(",",substr($gtdata['presentationId'],0,strlen($gtdata['presentationId'])-1));
				foreach($presentationValue as $pl)
				{
					$add = true;
					for($i=0;$i<count($presid);$i++)
					{
						if($presid[$i] == $pl['presentationId'])
						{
							$add = false;
						}
					}
					if($add)
					{
						$data[$pl->presentationId] = $pl->title;
					}
				}
			}

			$sysModel = new Model_DbTable_Gtsystems();
			$system = $sysModel->fetchAll();
			$sysSubModel = new Model_DbTable_Gtsubsystems();
			$subsystem = $sysSubModel->fetchAll();
			$sysNames = array();
			$sysNames[''] = 'Select an Option';
			$sysSubNames[''] = 'Select an Option';
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
	            ->addFilter('StripTags')
	            ->addFilter('StringTrim')
	            ->addValidator('NotEmpty');

	       	$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);

			$eoh = new Zend_Form_Element_Text('EOH');
	        $eoh->setLabel('EOH at Occurence')
			->addDecorator('Htmltag', array('tag' => 'br'))
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::int());
			$dof = new ZendX_JQuery_Form_Element_DatePicker('DOF',
			array('jQueryParams' => array('dateFormat'=>'yy-mm-dd','defaultDate' => '0','changeYear' =>'true')));
			$dof->setLabel('Date of ' . $doflabel)
		    ->addDecorator('Htmltag',array('tag' => 'br'))
		    ->addValidator(Model_Validators::dateval())
		    ->addFilter('StripTags')
		    ->addFilter('StringTrim');

			$insp = array('' => 'Select an Option','Minor' => 'Minor','HGPI' => 'HGPI' , 'EHGPI' => 'EHGPI' , 'Major' => 'Major' , 'Unscheduled' => 'Unscheduled','Others' => 'Others');

			$toi = new Zend_Form_Element_Select('TOI');
			$toi->setLabel('Type of Inspection')
				->addMultiOptions($insp)
				->addDecorator('Htmltag', array('tag' => 'p'))
	            ->addFilter('StripTags')
	            ->addFilter('StringTrim')
	            ->addValidator('NotEmpty');

			$prestitle1 = new Zend_Form_Element_Text('prestitle1');
	        $prestitle1->setLabel('Attachment Title')
			->addDecorator('Htmltag', array('tag' => 'br'))
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());

	        $content1=new Zend_Form_Element_File('content1');
	        $content1->setLabel('Upload the File')
	                ->setDestination($appath . '/public/uploads');

			$addmore = new Zend_Form_Element_Button('addmore');
	        $addmore->setAttrib('id', 'addmore')
					->setLabel("...")
					->setAttrib("class","gt-add");



			$prestitle2 = new Zend_Form_Element_Text('prestitle2');
	        $prestitle2->setLabel('Attachment Title')
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());

	        $content2=new Zend_Form_Element_File('content2');
	        $content2->setLabel('Upload the File')
	                ->setDestination($appath . '/public/uploads');


			$del2 = new Zend_Form_Element_Button('del2');
	        $del2->setAttrib('id', 'del2')
					->setLabel("...")
					->setAttrib("class","gt-delete");

			$prestitle3 = new Zend_Form_Element_Text('prestitle3');
	        $prestitle3->setLabel('Attachment Title')
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());

	        $content3=new Zend_Form_Element_File('content3');
	        $content3->setLabel('Upload the File')
	                ->setDestination($appath . '/public/uploads');


			$del3 = new Zend_Form_Element_Button('del3');
	        $del3->setAttrib('id', 'del3')
					->setLabel("...")
					->setAttrib("class","gt-delete");

			$prestitle4 = new Zend_Form_Element_Text('prestitle4');
	        $prestitle4->setLabel('Attachment Title')
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());

	        $content4=new Zend_Form_Element_File('content4');
	        $content4->setLabel('Upload the File')
	                ->setDestination($appath . '/public/uploads');


			$del4 = new Zend_Form_Element_Button('del4');
	        $del4->setAttrib('id', 'del4')
					->setLabel("...")
					->setAttrib("class","gt-delete");

			$prestitle5 = new Zend_Form_Element_Text('prestitle5');
	        $prestitle5->setLabel('Attachment Title')
	        ->addValidator('NotEmpty')
	        ->addFilter('StripTags')
	        ->addFilter('StringTrim')
	        ->addValidator(Model_Validators::alnum());

	        $content5=new Zend_Form_Element_File('content5');
	        $content5->setLabel('Upload the File')
	                ->setDestination($appath . '/public/uploads');

			$del5 = new Zend_Form_Element_Button('del5');
	        $del5->setAttrib('id', 'del5')
					->setLabel("...")
					->setAttrib("class","gt-delete");


			$info2= new Zend_Form_Element_Hidden('info2');
    		$info2->setLabel("Attach Files")
			->addDecorator('Htmltag', array('tag' => 'b'));

			$info= new Zend_Form_Element_Hidden('info');
    		$info->setLabel("(allowed formats - pdf,ppt,pptx,xls,xlsx,doc,docx,jpg,jpeg,png,gif)")
			->addDecorator('Htmltag', array('tag' => 'b'));

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
	                ->addFilter('StringTrim');


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

	        $this->addElements(array($id,$gtid,$sys,$subsys,$eoh,$dof,$toi,
	        $info2,$info,$prestitle1,$content1,$prestitle2,
	        $content2,$del2,$prestitle3,$content3,$del3,$prestitle4,
	        $content4,$del4,$prestitle5,$content5,$del5,$addmore,$pid, $Title, $Data, $submit));

    }

}

?>