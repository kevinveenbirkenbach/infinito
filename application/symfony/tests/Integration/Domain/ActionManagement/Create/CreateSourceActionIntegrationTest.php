<?php

namespace Tests\Integration\Domain\ActionManagement\Create;

use App\Domain\ActionManagement\Create\CreateSourceAction;
use App\Domain\ActionManagement\ActionService;
use App\Domain\ActionManagement\Create\CreateActionInterface;
use App\Domain\ActionManagement\ActionServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Source\PureSourceInterface;
use App\Domain\RequestManagement\Action\RequestedActionService;
use App\Domain\RequestManagement\Right\RequestedRightService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DBAL\Types\ActionType;
use App\Domain\RequestManagement\User\RequestedUserService;
use App\Domain\UserManagement\UserSourceDirectorService;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\FormManagement\RequestedActionFormBuilderService;
use App\Domain\FormManagement\FormClassNameService;
use App\Domain\RequestManagement\Entity\RequestedEntityService;
use App\Entity\Source\PureSource;
use App\Attribut\ClassAttributInterface;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryService;
use App\Domain\SecureManagement\SecureRequestedRightCheckerService;
use App\Domain\RightManagement\RightTransformerService;

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
     * @var ActionServiceInterface
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
        $this->actionService = new ActionService($this->requestedActionService, $secureRequestedRightChecker, $this->requestStack, $layerRepositoryFactoryService, $entityFormBuilderService, $entityManager);
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
