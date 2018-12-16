<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

abstract class AppAbstractController extends AbstractRestfulController
{
	private $entityManager;

	private $serviceManager;

	public function __construct($entityManager, $serviceManager)
	{
		$this->entityManager = $entityManager;
		$this->serviceManager = $serviceManager;
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

	public function getList()
	{
	    $entities = $this->getServiceManager()->search();
	    $response = new AppHttpResponse($entities);
	    return new JsonModel($response->getData());
	}
	
	public function get($id)
	{
	    $entity = $this->getServiceManager()->find($id);
	    $response = new AppHttpResponse($entity);
	    return new JsonModel($response->getData());
	}
	
	public function delete($id)
	{
	    $this->getServiceManager()->delete($id);
	    return new JsonModel(['data' => "Record with id {$id} was deleted"]);
	}
}
