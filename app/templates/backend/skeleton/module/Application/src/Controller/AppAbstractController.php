<?php
namespace Application\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

abstract class AppAbstractController extends AbstractRestfulController
{
	protected abstract function service();
}

