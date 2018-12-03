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
	
	public function getServiceManager(){
		return $this->entityManager;
	}
}

