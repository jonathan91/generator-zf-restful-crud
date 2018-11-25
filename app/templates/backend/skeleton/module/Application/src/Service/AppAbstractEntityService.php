<?php
namespace Application\Service;

use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\ServiceManager;
use Zend\Form\Annotation\AnnotationBuilder;
use Application\Exceptions\ValidationException;

abstract class AppAbstractEntityService
{
    /**
     * 
     * @var EntityManager
     */
    protected $ormEntityManager;
    /**
     * 
     * @var ServiceManager
     */
    protected $serviceManager;
    
    public function __construct(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }
    
    public function getOrmEntityManager()
    {
        if (null === $this->ormEntityManager) {
            $this->ormEntityManager = $this->serviceManager->get(EntityManager::class);
        }
        return $this->ormEntityManager;
    }
    
    public function add($entity)
    {
        try {
            $this->validation($entity);
            $this->getOrmEntityManager()->persist($entity);
            $this->getOrmEntityManager()->flush();
        } catch (\Exception $exceptionError) {
            throw new \Exception($exceptionError->getMessage(), $exceptionError->getCode());
        }
        return $entity;
    }
    
    public function edit($entity)
    {
        try {
            $this->validation($entity);
            $this->getOrmEntityManager()->merge($entity);
            $this->getOrmEntityManager()->flush();
        } catch (\Exception $exceptionError) {
            throw new \Exception($exceptionError->getMessage(), $exceptionError->getCode());
        }
        return $entity;
    }
    
    public function delete($id)
    {
        try {
            $entity = $this->find($id);
            $this->getOrmEntityManager()->remove($entity);
            $this->getOrmEntityManager()->flush();
        } catch (\Exception $exceptionError) {
            throw new \Exception($exceptionError->getMessage(), $exceptionError->getCode());
        }
    }

    public function validation($entity)
    {
    	$annotation = new AnnotationBuilder();
    	$entityForm = $annotation->createForm($entity);
    	$entityForm->bind($entity);
    	$entityForm->setData($entity->toArray());
    	if (!$entityForm->isValid()){
    		throw new ValidationException($entityForm->getMessages());
    	}
    }
}
