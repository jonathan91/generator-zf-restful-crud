<?php
namespace <%= packageName %>\Controller;

use <%= packageName %>\Entity\<%= className %>;
use Zend\View\Model\JsonModel;
use Application\Controller\AppAbstractController;
use Application\Http\AppHttpResponse;

class <%= className %>Controller extends AppAbstractController
{

    public function listAction()
    {
    	$entities = $this->getServiceManager()->search();
    	$response = new AppHttpResponse($entities);
    	return new JsonModel($response->getData());
    }

    public function getAction()
    {
		$id = $this->params()->fromRoute('id');
    	$entity = $this->getServiceManager()->find($id);
    	$response = new AppHttpResponse($entity);
    	return new JsonModel($response->getData());
    }

    public function createAction()
    {
		$request   = $this->getRequest();
    	$entity = new <%= className %>($request->getPost());
    	$entity = $this->getServiceManager()->add($entity);
    	$response = new AppHttpResponse($entity);
    	return new JsonModel($response->getData());
    }

    public function updateAction()
    {
		$id = $this->params()->fromRoute('id');
		$request   = $this->getRequest();
    	$entity = new <%= className %>($request->getPost());
    	$entity->setId($id);
    	$entity = $this->getServiceManager()->edit($entity);
    	$response = new AppHttpResponse($entity);
    	return new JsonModel($response->getData());
    }

    public function deleteAction()
    {
		$id = $this->params()->fromRoute('id');
    	$this->getServiceManager()->delete($id);
    	return new JsonModel(['data' => "Record with id {$id} was deleted"]);
    }
}
