<?php
namespace <%= packageName %>\Controller;

use <%= packageName %>\Entity\<%= className %>;
use Zend\View\Model\JsonModel;
use Application\Controller\AppAbstractController;
use Application\Http\AppHttpResponse;

class <%= className %>Controller extends AppAbstractController
{

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

    public function create($request)
    {
    	$entity = new <%= className %>($request);
    	$entity = $this->getServiceManager()->add($entity);
    	$response = new AppHttpResponse($entity);
    	return new JsonModel($response->getData());
    }

    public function update($id, $request)
    {
    	$entity = new <%= className %>($request);
    	$entity->setId($id);
    	$entity = $this->getServiceManager()->edit($entity);
    	$response = new AppHttpResponse($entity);
    	return new JsonModel($response->getData());
    }

    public function delete($id)
    {
    	$this->getServiceManager()->delete($id);
    	return new JsonModel(['data' => "Record with id {$id} was deleted"]);
    }
}
