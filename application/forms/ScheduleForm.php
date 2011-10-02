<?php

class Form_ScheduleForm extends Zend_Form{

    public function  __construct($options = null) {
		parent::__construct($options);

                $this->setName('Add Schedule');
                $this->addElementPrefixPath('Hive_Form_Decorators','Hive/Form/Decorators','decorator');
                
                $days = new Zend_Form_Element_Text('days');
                $days->setLabel('No. of Days')
			    ->addDecorator('Htmltag',array('tag' => 'br'))
			    ->setRequired(true)
			    ->addValidator('NotEmpty')
			    ->addValidator(Model_Validators::int())
			    ->addFilter('StripTags')
			    ->addFilter('StringTrim');
			    
			   	$f_day = new ZendX_JQuery_Form_Element_DatePicker('first_day',
				array('jQueryParams' => array('dateFormat'=>'yy-mm-dd','defaultDate' => '0','changeYear' =>'true')));
				$f_day->setLabel('First Day')
			    ->setRequired(true)
			    ->addDecorator('Htmltag',array('tag' => 'br'))
			    ->addValidator('NotEmpty')
			    ->addValidator(Model_Validators::dateval())
			    ->addFilter('StripTags')
			    ->addFilter('StringTrim');
			    
			    $l_day = new ZendX_JQuery_Form_Element_DatePicker('last_day',
				array('jQueryParams' => array('dateFormat'=>'yy-mm-dd','defaultDate' => '0','changeYear' =>'true')));
				$l_day->setLabel('Last Day')
			    ->setRequired(true)
			    ->addDecorator('Htmltag',array('tag' => 'br'))
			    ->addValidator('NotEmpty')
			    ->addValidator(Model_Validators::dateval())
			    ->addFilter('StripTags')
			    ->addFilter('StringTrim'); 
			    
			    $no_event = new Zend_Form_Element_Text('events');
                $no_event->setLabel('No. of Events')
			    ->addDecorator('Htmltag',array('tag' => 'br'))
			    ->setRequired(true)
			    ->addValidator('NotEmpty')
			    ->addValidator(Model_Validators::int())
			    ->addFilter('StripTags')
			    ->addFilter('StringTrim');
			    
			    $submit = new Zend_Form_Element_Button('submit');
                $submit->addDecorator('Htmltag',array('tag' => 'p'));
                $submit->setAttrib('id', 'submitbutton')
						->setAttrib('class','user-save')
                        ->setAttrib('type', 'submit');
			    
			    $this->addElements(array($days,$f_day,$l_day,$no_event,$submit));
                                
   	}
}

