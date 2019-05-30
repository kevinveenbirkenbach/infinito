<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

/**
 * @author kevinfrantz
 *
 * @deprecated Don't test private functions. Just test public functions!
 */
abstract class AbstractTestCase extends TestCase
{
    /**
     * Call protected/private method of a class.
     *
     * @see https://jtreminio.com/blog/unit-testing-tutorial-part-iii-testing-protected-private-methods-coverage-reports-and-crap/
     *
     * @param object &$object    Instantiated object that we will run method on
     * @param string $methodName Method name to call
     * @param array  $parameters array of parameters to pass into method
     *
     * @return mixed method return
     */
    public function invokeMethod(object &$object, string $methodName, array $parameters = [])
    {
        $reflection = $this->getReflectionClassByObject($object);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    /**
     * @param object $object
     * @param string $property
     * @param mixed  $value
     */
    public function setProperty(object &$object, string $property, $value): void
    {
        $reflectionClass = $this->getReflectionClassByObject($object);
        $reflectionProperty = $reflectionClass->getProperty($property);
        $reflectionProperty->setAccessible(true);
        $reflectionProperty->setValue($object, $value);
    }

    /**
     * @param object $object
     *
     * @return \ReflectionClass
     */
    private function getReflectionClassByObject(object &$object): \ReflectionClass
    {
        return new \ReflectionClass(get_class($object));
    }
}
