<?php

class Plugin_BookmarkLayout extends Zend_Controller_Plugin_Abstract  {

    protected $_view;
    public function  preDispatch(Zend_Controller_Request_Abstract $request) {
        parent::preDispatch($request);
        
    }
    public function  dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        parent::dispatchLoopStartup($request);
        if($request->isXmlHttpRequest())
            return;
        if($request->getActionName()!='view')
            return;
        $front = Zend_Controller_Front::getInstance();
        if (!$front->hasPlugin(
                        'Zend_Controller_Plugin_ActionStack')) {
            $actionStack = new
                    Zend_Controller_Plugin_ActionStack();
            $front->registerPlugin($actionStack, 97);
        } else {
            $actionStack = $front->getPlugin(
                            'Zend_Controller_Plugin_ActionStack');
        }
        //Set category to the current controller for bookmarking
        Zend_Registry::set('controller',$request->getControllerName());
        $myBookmarkAction = clone($request);
        $myBookmarkAction->setActionName('view')
                        ->setControllerName('bookmark');
        $actionStack->pushStack($myBookmarkAction);
        
    }
}
?>