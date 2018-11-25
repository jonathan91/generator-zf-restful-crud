<?php
namespace <%= packageName %>\Controller;

use <%= packageName %>\Entity\<%= className %>;
use Zend\View\Model\JsonModel;
use Application\Controller\AppAbstractController;
use Application\Http\ResponseBag;

class <%= className %>Controller extends AppAbstractController
{

    protected function service()
    {
        return $this->getServiceLocator()->get('<%= packageName %>\<%= className %>Service');
    }

    public function getList()
    {
    	$entities = $this->service()->search();
    	$response = new ResponseBag($entities);
    	return new JsonModel($response->getData());
    }

    public function get($id)
    {
    	$entity = $this->service()->find($id);
    	$response = new ResponseBag($entity);
    	return new JsonModel($response->getData());
    }

    public function create($request)
    {
    	$entity = new <%= className %>($request);
    	$entity = $this->service()->add($entity);
    	$response = new ResponseBag($entity);
    	return new JsonModel($response->getData());
    }

    public function update($id, $request)
    {
    	$entity = new <%= className %>($request);
    	$entity->setId($id);
    	$entity = $this->service()->edit($entity);
    	$response = new ResponseBag($entity);
    	return new JsonModel($response->getData());
    }

    public function delete($id)
    {
    	$this->service()->delete($id);
    	return new JsonModel(['data' => "Record with id {$id} was deleted"]);
    }
}
