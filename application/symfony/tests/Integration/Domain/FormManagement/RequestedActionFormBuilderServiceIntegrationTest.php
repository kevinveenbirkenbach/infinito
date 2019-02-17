<?php

namespace tests\Integration\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityInterface;
use Infinito\Entity\Source\PureSource;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderService;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\DBAL\Types\ActionType;
use Symfony\Component\Form\Form;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;

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
