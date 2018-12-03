<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

abstract class AppAbstractController extends AbstractRestfulController
{
	private $entityManager;
  
  	public function __construct($entityManager) 
  	{
    		$this->entityManager = $entityManager;
  	}
	
	public function setEventManager(EventManagerInterface $events)
    	{
        	parent::setEventManager($events);
        	$events->attach('dispatch', array($this, 'isAuthorized'), 10);
	}
	
	public function getServiceManager()
	{
		return $this->entityManager;
	}
    	
	protected function isAuthorized()
	{
		$request = $event->getRequest();
		$response = $event->getResponse();
		$isAuthorizationRequired = $event->getRouteMatch()->getParam('authorizationIsRequired');
		$config = $event->getApplication()->getServiceManager()->get('Config');
		//require security module to validate jwt
	}
}

