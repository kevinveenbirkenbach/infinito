<?php

namespace tests\Unit\Domain\ParameterManagement;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Domain\ParameterManagement\OptionalGetParameterServiceInterface;
use Infinito\Exception\NotDefinedException;
use Infinito\Domain\ParameterManagement\Parameter\VersionParameter;
use Infinito\Domain\ParameterManagement\ParameterFactory;
use Infinito\Domain\ParameterManagement\ValidGetParametersService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * This class is a bit messed up because it is an recycled class of an other unit.
 *
 * @author kevinfrantz
 */
class ValidGetParameterServiceTest extends KernelTestCase
{
    /**
     * @var Request
     */
    private $currentRequest;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var OptionalGetParameterServiceInterface
     */
    private $validGetParameterService;

    public function setUp(): void
    {
        $this->currentRequest = new Request();
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->requestStack->method('getCurrentRequest')->willReturn($this->currentRequest);
        $parameterFactory = new ParameterFactory();
        self::bootKernel();
        $validator = self::$container->get(ValidatorInterface::class);
        $this->validGetParameterService = new ValidGetParametersService($this->requestStack, $parameterFactory, $validator);
    }

    public function testHasAndGetParameter(): void
    {
        $parameterFactory = new ParameterFactory();
        foreach ($parameterFactory->getAllParameters()->getKeys() as $key) {
            $this->assertFalse($this->validGetParameterService->hasParameter($key));
            switch ($key) {
                case VersionParameter::getKey():
                    $value = 1;
                    break;
                default:
                    $value = true;
            }
            $this->currentRequest->query->set($key, $value);
            $this->assertTrue($this->validGetParameterService->hasParameter($key));
            $this->assertEquals($value, $this->validGetParameterService->getParameter($key));
        }
        $this->expectException(NotDefinedException::class);
        $this->validGetParameterService->getParameter('12312312asdas');
    }

    public function testSetParameterException(): void
    {
        $this->expectException(NotDefinedException::class);
        $this->validGetParameterService->getParameter(VersionParameter::getKey());
    }
}
