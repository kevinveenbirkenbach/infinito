<?php

namespace Infinito\Domain\ParameterManagement;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use HaydenPierce\ClassFinder\ClassFinder;
use Infinito\Domain\ParameterManagement\Parameter\ParameterInterface;
use Infinito\Exception\NoValidChoiceException;

/**
 * @author kevinfrantz
 */
final class ParameterFactory implements ParameterFactoryInterface
{
    /**
     * @var string Namespace under which the parameters are stored
     */
    const PARAMETER_NAMESPACE = 'Infinito\Domain\ParameterManagement\Parameter';

    /**
     * @var ArrayCollection|Collection|ParameterInterface[]
     */
    private $parameters;

    /**
     * @param string $class
     *
     * @return bool True if an initialisation of the class is possible
     */
    private function initPossible(string $class): bool
    {
        $reflectionClass = new \ReflectionClass($class);
        if ($reflectionClass->isAbstract() || $reflectionClass->isInterface()) {
            return false;
        }

        return true;
    }

    private function initParameters(): void
    {
        $this->parameters = new ArrayCollection();
        $classFinder = new ClassFinder();
        $parameterClasses = $classFinder->getClassesInNamespace(self::PARAMETER_NAMESPACE);
        foreach ($parameterClasses as $parameterClass) {
            if ($this->initPossible($parameterClass)) {
                $parameter = new $parameterClass();
                $this->parameters->set($parameter::getKey(), $parameter);
            }
        }
    }

    public function __construct()
    {
        $this->initParameters();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\ParameterFactoryInterface::getParameter()
     */
    public function getParameter(string $key): ParameterInterface
    {
        $parameter = $this->parameters->get($key);
        if ($parameter) {
            return $parameter;
        }
        throw new NoValidChoiceException("The parameter for key <<$key>> doesn't exist!");
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\ParameterFactoryInterface::getAllParameters()
     */
    public function getAllParameters(): Collection
    {
        return $this->parameters;
    }
}
