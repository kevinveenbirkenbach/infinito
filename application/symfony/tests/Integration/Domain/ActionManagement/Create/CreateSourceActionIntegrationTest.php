<?php

namespace Tests\Integration\Domain\ActionManagement\Create;

use Infinito\Domain\ActionManagement\Create\CreateSourceAction;
use Infinito\Domain\ActionManagement\ActionDAOService;
use Infinito\Domain\ActionManagement\Create\CreateActionInterface;
use Infinito\Domain\ActionManagement\ActionDAOServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Entity\Source\PureSourceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionService;
use Infinito\Domain\RequestManagement\Right\RequestedRightService;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\RequestManagement\User\RequestedUserService;
use Infinito\Domain\UserManagement\UserSourceDirectorService;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderService;
use Infinito\Domain\FormManagement\FormClassNameService;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityService;
use Infinito\Entity\Source\PureSource;
use Infinito\Attribut\ClassAttributInterface;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerService;
use Infinito\Domain\RightManagement\RightTransformerService;

/**
 * @todo Implement test and logic!!!!!
 *
 * @author kevinfrantz
 */
class CreateSourceActionIntegrationTest extends KernelTestCase
{
    /**
     * @var CreateActionInterface
     */
    private $createSourceAction;

    /**
     * @var ActionDAOServiceInterface
     */
    private $actionService;

    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var RequestStack
     */
    private $requestStack;

    public function setUp(): void
    {
        self::bootKernel();
        $formFactory = self::$container->get('form.factory');
        $entityManager = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $security = $this->createMock(Security::class);
        $userSourceDirectorService = new UserSourceDirectorService($entityManager, $security);
        $requestedEntityService = new RequestedEntityService();
        $requestedRightService = new RequestedRightService($requestedEntityService);
        $requestedUserService = new RequestedUserService($userSourceDirectorService, $requestedRightService);
        $this->requestedActionService = new RequestedActionService($requestedUserService);
        $this->requestedActionService->setActionType(ActionType::CREATE);
        $formClassNameService = new FormClassNameService();
        $entityFormBuilderService = new RequestedActionFormBuilderService($formFactory, $formClassNameService, $this->requestedActionService);
        $this->request = new Request();
        $this->requestStack = new RequestStack();
        $this->requestStack->push($this->request);
        $layerRepositoryFactoryService = new LayerRepositoryFactoryService($entityManager);
        $rightTransformerService = new RightTransformerService();
        $secureRequestedRightChecker = new SecureRequestedRightCheckerService($rightTransformerService);
        $this->actionService = new ActionDAOService($this->requestedActionService, $secureRequestedRightChecker, $this->requestStack, $layerRepositoryFactoryService, $entityFormBuilderService, $entityManager);
        $this->createSourceAction = new CreateSourceAction($this->actionService);
    }

    public function testPreconditions(): void
    {
        $this->assertEquals($this->request, $this->requestStack->getCurrentRequest());
    }

    public function testCreateWithGuestUser(): void
    {
        $this->request->setMethod(Request::METHOD_POST);
        $this->request->attributes->set(ClassAttributInterface::CLASS_ATTRIBUT_NAME, PureSource::class);
        $this->assertInstanceOf(PureSourceInterface::class, $this->createSourceAction->execute());
    }

//     public function testCreatedWithKnownUser(): void
//     {}
}
