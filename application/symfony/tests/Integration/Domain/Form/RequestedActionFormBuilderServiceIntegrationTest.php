<?php

namespace tests\Integration\Domain\Form;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\Form\RequestedActionFormBuilderService;
use Infinito\Domain\Form\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\Request\Action\RequestedActionServiceInterface;
use Infinito\Domain\Request\Entity\RequestedEntityInterface;
use Infinito\Domain\Request\Entity\RequestedEntityServiceInterface;
use Infinito\Entity\Source\PureSource;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Form\Form;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilderServiceIntegrationTest extends KernelTestCase
{
    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @var RequestedActionFormBuilderService
     */
    private $requestedActionFormBuilderService;

    /**
     * @var RequestedEntityInterface
     */
    private $requestedEntity;

    /**
     * {@inheritdoc}
     *
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    public function setUp(): void
    {
        self::bootKernel();
        $this->requestedActionFormBuilderService = self::$container->get(RequestedActionFormBuilderServiceInterface::class);
        $this->requestedEntity = self::$container->get(RequestedEntityServiceInterface::class);
        $this->requestedActionService = self::$container->get(RequestedActionServiceInterface::class);
        $this->requestedActionService->setActionType(ActionType::CREATE);
    }

    public function testCreate(): void
    {
        $class = PureSource::class;
        $this->requestedEntity->setClass($class);
        $result = $this->requestedActionFormBuilderService->create($this->requestedActionService);
        $this->assertInstanceOf(FormBuilderInterface::class, $result);
        $this->assertInstanceOf(Form::class, $result->getForm());
        $this->assertTrue(method_exists($result->getForm(), 'isValid'));
        //Tests if the origine builder and the service function return the same value by the requestedActionService
        $this->assertEquals($this->requestedActionFormBuilderService->create($this->requestedActionService), $this->requestedActionFormBuilderService->createByService());
    }
}
