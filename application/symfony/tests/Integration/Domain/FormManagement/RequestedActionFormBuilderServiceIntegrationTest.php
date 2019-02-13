<?php

namespace tests\Integration\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Entity\Source\PureSource;
use App\Domain\FormManagement\RequestedActionFormBuilderService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Domain\FormManagement\FormClassNameService;
use App\Domain\RequestManagement\Action\RequestedActionService;
use App\Domain\RequestManagement\User\RequestedUserService;
use App\Domain\RequestManagement\Right\RequestedRightService;
use App\Domain\UserManagement\UserSourceDirectorServiceInterface;
use App\DBAL\Types\ActionType;
use App\Domain\RequestManagement\Entity\RequestedEntityService;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

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
        $formFactory = self::$container->get('form.factory');
        //$entityManager = self::$container->get('doctrine.orm.default_entity_manager');
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $userSourceDirectorService = $this->createMock(UserSourceDirectorServiceInterface::class);
        $formClassNameService = new FormClassNameService();
        $layerRepositoryFactoryService = new LayerRepositoryFactoryService($entityManager);
        $this->requestedEntity = new RequestedEntityService($layerRepositoryFactoryService);
        $requestedRightService = new RequestedRightService($this->requestedEntity);
        $requestedRightService->setRequestedEntity($this->requestedEntity);
        $requestedUserService = new RequestedUserService($userSourceDirectorService, $requestedRightService);
        $this->requestedActionService = new RequestedActionService($requestedUserService);
        $this->requestedActionService->setActionType(ActionType::CREATE);
        $this->requestedActionFormBuilderService = new RequestedActionFormBuilderService($formFactory, $formClassNameService, $this->requestedActionService);
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
