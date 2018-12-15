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

	public function getServiceManager()
	{
		return $this->serviceManager;
	}

	public function getEntityManager()
	{
		return $this->entityManager;
	}
}

