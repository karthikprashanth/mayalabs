<?php

class Form_AttachmentsForm extends Zend_Form{

    public function  __construct($options = null) {
		parent::__construct($options);

                $Title = new Zend_Form_Element_Text('title');
                $Title->setLabel('Attachment Title')
                ->setRequired(true)
                ->addValidator('NotEmpty')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
				->setAttrib('id','title')
                ->addValidator(Model_Validators::alnum());


				$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
                $content=new Zend_Form_Element_File('data');
                $content->setLabel('Upload the Attachment')
						->setAttrib('id','filepath')
                        ->setDestination($appath . '/public/uploads');
						
				$gtid = new Zend_Form_Element_Hidden('gtid');
	        	$gtid->setAttrib('value', '1');

                $submit = new Zend_Form_Element_Submit('submit');
                $submit->setAttrib('id', 'upload')
						->setAttrib('class','gt-add')
						->setLabel("Upload");

                $this->addElements(array($Title,$content,$submit));
    }
}

?>
