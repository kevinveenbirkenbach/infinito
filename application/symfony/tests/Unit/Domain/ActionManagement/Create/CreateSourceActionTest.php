<?php

namespace tests\Unit\Domain\ActionManagement\Create;

use PHPUnit\Framework\TestCase;
use App\Domain\ActionManagement\Create\CreateSourceAction;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Source\PureSource;
use App\Attribut\ClassAttributInterface;
use App\Attribut\SlugAttributInterface;
use App\Entity\Source\PureSourceInterface;
use App\Domain\ActionManagement\ActionService;
use Doctrine\ORM\EntityManagerInterface;
use App\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use App\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use App\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Symfony\Component\Form\FormBuilderInterface;
use App\Form\Source\PureSourceTypeInterface;

/**
 * @author kevinfrantz
 */
class CreateSourceActionTest extends TestCase
{
    public function testCreatePureSource(): void
    {
        $request = new Request();
        $request->setMethod(Request::METHOD_POST);
        $request->query->set(ClassAttributInterface::CLASS_ATTRIBUT_NAME, PureSource::class);
        $request->request->set(SlugAttributInterface::SLUG_ATTRIBUT_NAME, 'randomname');
        $requestedActionService = $this->createMock(RequestedActionServiceInterface::class);
        $secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerServiceInterface::class);
        $entityManager = $this->createMock(EntityManagerInterface::class);
        $pureSourceType = $this->createMock(PureSourceTypeInterface::class);
        $pureSourceType->method('isValid')->willReturn(true);
        $formBuilderInterface = $this->createMock(FormBuilderInterface::class);
        $formBuilderInterface->method('getForm')->willReturn($pureSourceType);
//         $formBuilderInterface->method('isValid')->willReturn(true);
        $requestedActionFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
        $requestedActionFormBuilderService->method('createByService')->willReturn($formBuilderInterface);
        $requestStack = $this->createMock(RequestStack::class);
        $requestStack->method('getCurrentRequest')->willReturn($request);
        $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
        $actionService = new ActionService($requestedActionService, $secureRequestedRightChecker, $requestStack, $layerRepositoryFactoryService, $requestedActionFormBuilderService, $entityManager);
        $createSourceAction = new CreateSourceAction($actionService);
        $result = $createSourceAction->execute();
        $this->assertInstanceOf(PureSourceInterface::class, $result);
    }
}
