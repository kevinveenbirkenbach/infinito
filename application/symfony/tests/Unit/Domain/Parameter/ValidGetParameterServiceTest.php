<?php

namespace tests\Unit\Domain\Parameter;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Parameter\Parameter\VersionParameter;
use Infinito\Domain\Parameter\Parameter\ViewParameter;
use Infinito\Domain\Parameter\ParameterFactory;
use Infinito\Domain\Parameter\ValidGetParameterServiceInterface;
use Infinito\Domain\Parameter\ValidGetParametersService;
use Infinito\Exception\Collection\NotSetElementException;
use Infinito\Exception\Core\NotImplementedCoreException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
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
     * @var ValidGetParameterServiceInterface
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

    /**
     * @todo Move this tests to the functional test section
     */
    public function testHasAndGetParameter(): void
    {
        $parameterFactory = new ParameterFactory();
        foreach ($parameterFactory->getAllParameters()->getKeys() as $key) {
            $this->assertFalse($this->validGetParameterService->hasParameter($key));
            switch ($key) {
                case VersionParameter::getKey():
                    $value = 1;
                    break;
                case ViewParameter::getKey():
                    $value = ActionType::EXECUTE;
                    break;
                default:
                    $value = true;
            }
            $this->currentRequest->query->set($key, $value);
            $this->assertTrue($this->validGetParameterService->hasParameter($key));
            $this->assertEquals($value, $this->validGetParameterService->getParameter($key));
        }
    }

    public function testNotImplementedException(): void
    {
        $this->expectException(NotImplementedCoreException::class);
        $this->validGetParameterService->getParameter('12312312asdas');
    }

    public function testNotSetParameterException(): void
    {
        $this->expectException(NotSetElementException::class);
        $this->validGetParameterService->getParameter(VersionParameter::getKey());
    }
}
