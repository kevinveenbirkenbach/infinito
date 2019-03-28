<?php
namespace Infinito\Domain\ParameterManagement;

use Infinito\Domain\ParameterManagement\Parameter\ParameterInterface;
use HaydenPierce\ClassFinder\ClassFinder;
use Doctrine\Common\Collections\ArrayCollection;
use PhpCollection\CollectionInterface;
use Doctrine\Migrations\Configuration\Exception\ParameterIncompatibleWithFinder;
use PhpParser\ErrorHandler\Collecting;
use Doctrine\Common\Collections\Collection;
use Infinito\Domain\ParameterManagement\Parameter\AbstractParameter;

/**
 * 
 * @author kevinfrantz
 *
 */
final class ParameterFactory implements ParameterFactoryInterface
{
    /**
     * 
     * @var string Namespace under which the parameters are stored
     */
    const PARAMETER_NAMESPACE = 'Infinito\Domain\ParameterManagement\Parameter';
    
    /**
     * @var ArrayCollection|CollectionInterface|ParameterInterface[]
     */
    private $parameters;
    
    private function initPossible(string $class){
        if($class === AbstractParameter::class){
           return false; 
        }
        $reflectionClass = new \ReflectionClass($class);
        if($reflectionClass->isInterface()){
            return false;
        }
        return true;
    }
    private function initParameters():void{
        $this->parameters = new ArrayCollection();
        $classFinder = new ClassFinder();
        $parameterClasses = $classFinder->getClassesInNamespace(self::PARAMETER_NAMESPACE);
        foreach ($parameterClasses as $parameterClass){
            if($this->initPossible($parameterClass)){
                $parameter = new $parameterClass();
                $this->parameters->set($parameter::getKey(),$parameter);
            }
        }
    }
    
    public function __construct(){
        $this->initParameters();    
    }
    
    /**
     * 
     * {@inheritDoc}
     * @see \Infinito\Domain\ParameterManagement\ParameterFactoryInterface::getParameter()
     */
    public function getParameter(string $key): ParameterInterface
    {
       return $this->parameters->get($key); 
    }
    
    /**
     * {@inheritDoc}
     * @see \Infinito\Domain\ParameterManagement\ParameterFactoryInterface::getAllParameters()
     */
    public function getAllParameters():Collection{
        return $this->parameters;
    }
}

