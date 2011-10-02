<?php
class Form_ConferenceForm extends Zend_Form {
	public function  __construct($options = null) {
		parent::__construct($options);

		$place = new Zend_Form_Element_Text('place');
        $place->setLabel('Place')
        ->setRequired(true)
        ->addDecorator('Htmltag',array('tag' => 'br'))
        ->addValidator('NotEmpty')
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator(Model_Validators::alnum());
		
		$year = new Zend_Form_Element_Text('year');
        $year->setLabel('Year')
        ->setRequired(true)
        ->addDecorator('Htmltag',array('tag' => 'br'))
        ->addValidator('NotEmpty')
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator(Model_Validators::int())
		->addValidator(Model_Validators::stringlength(4,4));
		
		$plantObj = new Model_DbTable_Plant();
        $plantValue = $plantObj->fetchAll();

        $data = array();
        $data['']='Select an Option';
        foreach($plantValue as $pl) {
        	if($pl['plantId'] != 1)
			{
            	$data[$pl->plantId] = $pl->plantName;
			}
        }
	
        $host = new Zend_Form_Element_Select('host');
        $host->setLabel('Host')
        ->addMultiOptions($data)
        ->addDecorator('Htmltag',array('tag' => 'br'))
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
        ->addValidator('NotEmpty');
		
		$abstract = new Zend_Form_Element_Textarea('abstract');
        $abstract->setLabel('Synopsis')
                ->setRequired(true)
				->setAttrib('COLS','16')
		    	->setAttrib('ROWS','5')
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addValidator('NotEmpty')
                ->addFilter('StringTrim');
				
		$submit = new Zend_Form_Element_Button('submit');
        $submit->addDecorator('Htmltag', array('tag' => 'p'));
        $submit->setAttrib('id', 'submitbutton')
                ->setAttrib('type', 'submit')
				->setAttrib('class','gt-add');
		
		$this->addElements(array($place,$year,$host,$abstract,$submit));
		
	}
}

?>