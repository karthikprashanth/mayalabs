<?php
class Form_SearchForm extends Zend_Form {
	public function  __construct($options = null) {
		parent::__construct($options);
		$this->setAttrib('id','searchform');
		
		$searchBox = new Zend_Form_Element_Text('keyword');
	    $searchBox->setLabel('Search:')
	    ->setRequired(true)
	    ->addDecorator('Htmltag',array('tag' => 'br'))
	    ->addValidator(Model_Validators::alnum())
	    ->addFilter('StripTags')
	    ->addFilter('StringTrim');
		
		
		$this->addElements(array($searchBox));
	}
	
	public function showfilters()
	{
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
		$sysSubNames = array();
		$sysSubNames[''] = 'Select an Option';
		foreach($subsystem as $slist)
		{
			$sysSubNames[$slist['id']] = $slist['subSysName'];
		}
		
		$plantObj = new Model_DbTable_Plant();
        $plantValue = $plantObj->fetchAll();

        $data = array();
        $data['']='Select an Option';
        foreach($plantValue as $pl) {
        	if($pl['plantId'] != 1)
			{
            	$data[$pl->plantName] = $pl->plantName;
			}
        }

        $plant = new Zend_Form_Element_Select('plantname');
        $plant->setLabel('Plant')
        ->addMultiOptions($data)
        ->setRequired(true)
        ->addFilter('StripTags')
        ->addFilter('StringTrim')
         ->addValidator('NotEmpty');
		
		
		
		$type = new Zend_Form_Element_Select('type');
	    $type->setLabel('Search by Type')
	    ->addMultiOptions(array( ''=>'Select an Option','finding'=> 'Findings','upgrade' => 'Upgrades','lte' => 'LTE'))
	    ->setRequired(true)
	    ->addFilter('StripTags')
	    ->addFilter('StringTrim')
	    ->addDecorator('Htmltag',array('tag' => 'br'))
	    ->addValidator('NotEmpty');
		
		
		
		$sys = new Zend_Form_Element_Select('sysId');
		$sys->setLabel('Search by System Name')
			->addMultiOptions($sysNames)
			->addDecorator('Htmltag', array('tag' => 'br'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
            
       	$subsys = new Zend_Form_Element_Select('subSysId');
		$subsys->setLabel('Search by Sub System Name')
			->addMultiOptions($sysSubNames)
			->addDecorator('Htmltag', array('tag' => 'br'))
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
			
		$this->addElements(array($plant,$type,$sys,$subsys));				
	}

	public function showSubmit()
	{
		$submit = new Zend_Form_Element_Button('submit');
	    $submit->addDecorator('Htmltag',array('tag' => 'p'));
	    $submit->setAttrib('id', 'submitbutton')
	            ->setAttrib('type', 'submit');
		
		$this->addElements(array($submit));
	}
}

?>