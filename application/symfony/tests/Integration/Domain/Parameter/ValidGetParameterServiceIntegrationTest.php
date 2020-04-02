<?php

namespace tests\Integration\Domain\Parameter;

use Infinito\Domain\Parameter\Parameter\VersionParameter;
use Infinito\Domain\Parameter\ParameterFactory;
use Infinito\Domain\Parameter\ParameterFactoryInterface;
use Infinito\Domain\Parameter\ValidGetParameterServiceInterface;
use Infinito\Domain\Parameter\ValidGetParametersService;
use Infinito\Exception\Collection\NotSetElementException;
use Infinito\Exception\Core\NotImplementedCoreException;
use Infinito\Exception\Validation\GetParameterInvalidException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author kevinfrantz
 */
class ValidGetParameterServiceIntegrationTest extends KernelTestCase
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
     * @var ValidGetParameterServiceInterface
     */
    private $validGetParameterService;

    /**
     * @var ParameterFactoryInterface
     */
    private $parameterFactory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function setUp(): void
    {
        self::bootKernel();
        $this->currentRequest = new Request();
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->requestStack->method('getCurrentRequest')->willReturn($this->currentRequest);
        $this->parameterFactory = new ParameterFactory();
        $this->validator = self::$container->get(ValidatorInterface::class);
        $this->validGetParameterService = new ValidGetParametersService($this->requestStack, $this->parameterFactory, $this->validator);
    }

    public function testVersionCorrectType(): void
    {
        $key = VersionParameter::getKey();
        $value = 123;
        $this->currentRequest->query->set($key, $value);
        $result = $this->validGetParameterService->getParameter($key);
        $this->assertEquals($value, $result);
    }

    public function testVersionWrongType(): void
    {
        $versionKey = VersionParameter::getKey();
        $this->currentRequest->query->set($versionKey, 'adasdas');
        $this->expectException(GetParameterInvalidException::class);
        $this->validGetParameterService->getParameter($versionKey);
    }

    public function testConstructorInvalid(): void
    {
        $this->currentRequest->query->set(VersionParameter::getKey(), 'adasa');
        $this->expectException(GetParameterInvalidException::class);
        new ValidGetParametersService($this->requestStack, $this->parameterFactory, $this->validator);
    }

    public function testConstructorNotImplemented(): void
    {
        $this->currentRequest->query->set('asdwgwe', 'adasa');
        $this->expectException(NotImplementedCoreException::class);
        new ValidGetParametersService($this->requestStack, $this->parameterFactory, $this->validator);
    }

    public function testSetParameterException(): void
    {
        $this->expectException(NotSetElementException::class);
        $this->validGetParameterService->getParameter(VersionParameter::getKey());
    }
}
