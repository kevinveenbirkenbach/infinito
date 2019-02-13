<?php

namespace Tests\Integration\Domain\ActionManagement\Create;

use App\Domain\ActionManagement\Create\CreateSourceAction;
use App\Domain\ActionManagement\ActionService;
use App\Domain\ActionManagement\Create\CreateActionInterface;
use App\Domain\ActionManagement\ActionServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerInterface;
use App\Entity\Source\PureSourceInterface;
use App\Domain\RequestManagement\Action\RequestedActionService;
use App\Domain\RequestManagement\Right\RequestedRightService;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\DBAL\Types\ActionType;
use App\Domain\RequestManagement\User\RequestedUserService;
use App\Domain\UserManagement\UserSourceDirectorService;
use Symfony\Component\Security\Core\Security;
use App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;

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

    public function setUp(): void
    {
        self::bootKernel();
        $entityManager = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
        $security = $this->createMock(Security::class);
        $userSourceDirectorService = new UserSourceDirectorService($entityManager, $security);
        $requestedRightService = new RequestedRightService();
        $requestedUserService = new RequestedUserService($userSourceDirectorService, $requestedRightService);
        $this->requestedActionService = new RequestedActionService($requestedUserService);
        $this->requestedActionService->setActionType(ActionType::CREATE);
        $entityFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
        $requestStack = $this->createMock(RequestStack::class);
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerInterface::class);
        $this->actionService = new ActionService($this->requestedActionService, $secureRequestedRightChecker, $requestStack, $layerRepositoryFactoryService, $entityFormBuilderService, $entityManager);
        $this->createSourceAction = new CreateSourceAction($this->actionService);
    }

    public function testCreateWithGuestUser(): void
    {
        $this->assertInstanceOf(PureSourceInterface::class, $this->createSourceAction->execute());
    }

//     public function testCreatedWithKnownUser(): void
//     {}
}
