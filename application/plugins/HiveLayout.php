<?php

class Plugin_HiveLayout extends Zend_Controller_Plugin_Abstract  {

    protected $_view;
    public function  preDispatch(Zend_Controller_Request_Abstract $request) {
        parent::preDispatch($request);
//        $controller = $request->getControllerName();
//        $layout= Zend_Controller_Action_HelperBroker::getStaticHelper('Layout');
    }
    
    public function  dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        parent::dispatchLoopStartup($request);
        $controller = $request->getControllerName();
        if($request->isXmlHttpRequest())
            return;
        $front = Zend_Controller_Front::getInstance();
        if (!$front->hasPlugin('Zend_Controller_Plugin_ActionStack')) {
            $actionStack = new Zend_Controller_Plugin_ActionStack();
            $front->registerPlugin($actionStack, 97);
        }
        else{
            $actionStack = $front->getPlugin('Zend_Controller_Plugin_ActionStack');
        }
        
        $myProfileAction = clone($request);
        $myProfileAction->setActionName('index')->setControllerName('myprofile');
        $actionStack->pushStack($myProfileAction);

        $nameAction = clone($request);
        $nameAction->setActionName('displayname')->setControllerName('userprofile');
        $actionStack->pushStack($nameAction);

        if($controller!='dashboard'){
			Zend_Registry::set('sidebar2',true);
            return;
        }
        if(isset($_GET['keyword'])) {
            $_GET['keyword']='';
            unset($_GET['keyword']);
        }
        $advertAction = clone($request);
        $advertAction->setActionName('randomad')
                ->setControllerName('advertisement');
        $actionStack->pushStack($advertAction);
        
        $notificationAction = clone($request);
        $notificationAction->setActionName('view')->setControllerName('notification');
      	$actionStack->pushStack($notificationAction);

        $bookmarkAction = clone($request);
        $bookmarkAction->setActionName('list')->setControllerName('bookmark');
        $actionStack->pushStack($bookmarkAction);        

        $searchAction = clone($request);
        $searchAction->setActionName('index')->setControllerName('search');
      	$actionStack->pushStack($searchAction);

    }
}
?>
