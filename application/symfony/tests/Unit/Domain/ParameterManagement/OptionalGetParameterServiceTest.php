<?php

namespace tests\Unit\Domain\ParameterManagement;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Domain\ParameterManagement\OptionalGetParameterServiceInterface;
use Infinito\Domain\ParameterManagement\OptionalGetParameterService;
use Infinito\Exception\UnvalidParameterException;
use Infinito\Exception\NotDefinedException;

/**
 * @author kevinfrantz
 */
class OptionalGetParameterServiceTest extends TestCase
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
    private $optionalGetParameterService;

    public function setUp(): void
    {
        $this->currentRequest = new Request();
        $this->requestStack = $this->createMock(RequestStack::class);
        $this->requestStack->method('getCurrentRequest')->willReturn($this->currentRequest);
        $this->optionalGetParameterService = new OptionalGetParameterService($this->requestStack);
    }

    public function testConstructor(): void
    {
        $this->expectException(UnvalidParameterException::class);
        $this->currentRequest->query->set('asdwgwe', 'adasa');
        new OptionalGetParameterService($this->requestStack);
    }

    public function testHasAndGetParameter(): void
    {
        foreach (OptionalGetParameterServiceInterface::OPTIONAL_PARAMETERS as $key) {
            $this->assertFalse($this->optionalGetParameterService->hasParameter($key));
            $this->currentRequest->query->set($key, 'adasa');
            $this->assertTrue($this->optionalGetParameterService->hasParameter($key));
            $this->assertEquals('adasa', $this->optionalGetParameterService->getParameter($key));
        }
        $this->expectException(UnvalidParameterException::class);
        $this->optionalGetParameterService->getParameter('12312312asdas');
    }

    public function testSetParameterException(): void
    {
        $this->expectException(NotDefinedException::class);
        $this->optionalGetParameterService->getParameter(OptionalGetParameterServiceInterface::VERSION_PARAMETER);
    }
}
