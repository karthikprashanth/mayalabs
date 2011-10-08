<?php
class Form_GTDataForm extends Zend_Form {

    public function showform($gturbineid, $gtdataid, $gtdatatype) {
        $this->setName('GTData');

        $pObj = new Model_DbTable_Presentation();
        $presentationValue = $pObj->fetchAll("GTId = " . $gturbineid);

        $data = array();
        $data[''] = 'Select an Option';
        if ($gtdatatype == 'finding') {
            $doflabel = "Finding";
        } else {
            $doflabel = "Implementation";
        }
        if ($gtdataid == 0) {
            foreach ($presentationValue as $pl) {
                $data[$pl->presentationId] = $pl->title;
            }
        } else {
            $gtdatamodel = new Model_DbTable_Gtdata();
            $gtdata = $gtdatamodel->getData($gtdataid);

            $presid = explode(",", substr($gtdata['presentationId'], 0, strlen($gtdata['presentationId']) - 1));
            foreach ($presentationValue as $pl) {
                $add = true;
                for ($i = 0; $i < count($presid); $i++) {
                    if ($presid[$i] == $pl['presentationId']) {
                        $add = false;
                    }
                }
                if ($add) {
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
        foreach ($system as $list) {
            $sysNames[$list['sysId']] = $list['sysName'];
        }
        foreach ($subsystem as $slist) {
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
        $sys->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $subsys = new Zend_Form_Element_Select('subSysId');
        $subsys->setLabel('Sub System Name')
                ->addMultiOptions($sysSubNames)
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $subsys->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $appath = substr(APPLICATION_PATH, 0, strlen(APPLICATION_PATH) - 12);

        $eoh = new Zend_Form_Element_Text('EOH');
        $eoh->setLabel('EOH at Occurence')
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator(Model_Validators::int());
        $eoh->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $dof = new ZendX_JQuery_Form_Element_DatePicker('DOF',
                        array('jQueryParams' => array('dateFormat' => 'yy-mm-dd', 'defaultDate' => '0', 'changeYear' => 'true')));
        $dof->setLabel('Date of ' . $doflabel)
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addValidator(Model_Validators::dateval())
                ->addFilter('StripTags')
                ->addFilter('StringTrim');

        $insp = array('' => 'Select an Option', 'Minor' => 'Minor', 'HGPI' => 'HGPI', 'EHGPI' => 'EHGPI', 'Major' => 'Major', 'Unscheduled' => 'Unscheduled', 'Others' => 'Others');

        $toi = new Zend_Form_Element_Select('TOI');
        $toi->setLabel('Type of Inspection')
                ->addMultiOptions($insp)
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        $toi->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $addattach = new Zend_Form_Element_Button('addattach');
        $addattach->addDecorator('Htmltag', array('tag' => 'p'));
        $addattach->setAttrib('id', 'addattach')
                ->setLabel("Add Attachments")
                ->setAttrib('class', 'gt-add');
        $addattach->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $pid = new Zend_Form_Element_Multiselect('presentationId');
        $pid->setLabel('Or Choose an Existing Presentation')
                ->addMultiOptions($data)
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addFilter('StripTags')
                ->addFilter('StringTrim');
        $pid->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));


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
        $Title->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));


        $Data = new Zend_Form_Element_Textarea('data');
        $Data->setRequired(true)
                ->addDecorator('Htmltag', array('tag' => 'br'))
                ->addValidator('NotEmpty')
                ->addFilter('StringTrim');
        $Data->setDecorators(array('ViewHelper', array('Description', array('tag' => '', 'escape' => false)),
            'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $submit = new Zend_Form_Element_Button('submit');
        $submit->addDecorator('Htmltag', array('tag' => 'p'));
        $submit->setAttrib('id', 'submitbutton')
                ->setAttrib('class', 'gt-add')
                ->setAttrib('type', 'submit');
        $submit->setDecorators(array('ViewHelper', 'Description', 'Errors', array(array('data' => 'HtmlTag'), array('tag' => 'td',
                    'colspan' => '2', 'align' => 'center')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr'))
        ));

        $this->addElements(array($id, $gtid, $sys, $subsys, $eoh, $dof, $toi, $addattach, $pid, $Title, $Data, $submit));
        $this->setDecorators(array('FormElements', array(array('data' => 'HtmlTag'), array('tag' => 'table')), 'Form'));
    }

}

?>
