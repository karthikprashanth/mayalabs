<?php

class Form_GalleryForm extends Zend_Form{

    public function  __construct($options = null) {
		parent::__construct($options);

                $this->setName('Presentations');


                $Title = new Zend_Form_Element_Text('tag');
                $Title->setLabel('Photo Tag')
                ->setRequired(true)
                ->addDecorator('Htmltag',array('tag' => 'br'))
                ->addValidator('NotEmpty')
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator(Model_Validators::alnum());


				$appath = substr(APPLICATION_PATH,0,strlen(APPLICATION_PATH)-12);
                $content=new Zend_Form_Element_File('data');
                $content->setLabel('Upload the Photo')
                        ->setDestination($appath . '/public/uploads')
                        ->addDecorator('Htmltag',array('tag' => 'br'));
						
				$info= new Zend_Form_Element_Hidden('info');
    			$info->setLabel("(allowed formats - jpg,jpeg,png,gif)");

                $submit = new Zend_Form_Element_Button('submit');
                $submit->addDecorator('Htmltag',array('tag' => 'p'));
                $submit->setAttrib('id', 'submitbutton')
                        ->setAttrib('type', 'submit');
                
                $this->addElements(array($Title,$content,$info,$submit));
    }
}

?>
