<?php

namespace tests\Unit\Domain\Action\Create;

use PHPUnit\Framework\TestCase;
use Infinito\Domain\Action\Create\CreateSourceAction;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Entity\Source\PureSource;
use Infinito\Attribut\ClassAttributInterface;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Entity\Source\PureSourceInterface;
use Infinito\Domain\Action\ActionService;
use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Infinito\Domain\RepositoryManagement\LayerRepositoryFactoryServiceInterface;
use Infinito\Domain\Form\RequestedActionFormBuilderServiceInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author kevinfrantz
 */
class CreateSourceActionTest extends TestCase
{
//     public function testCreatePureSource(): void
//     {
//         $request = new Request();
//         $request->setMethod(Request::METHOD_POST);
//         $request->query->set(ClassAttributInterface::CLASS_ATTRIBUT_NAME, PureSource::class);
//         $request->request->set(SlugAttributInterface::SLUG_ATTRIBUT_NAME, 'randomname');
//         $requestedActionService = $this->createMock(RequestedActionServiceInterface::class);
//         $secureRequestedRightChecker = $this->createMock(SecureRequestedRightCheckerServiceInterface::class);
//         $entityManager = $this->createMock(EntityManagerInterface::class);
//         $pureSourceType = $this->createMock(PureSourceTypeInterface::class);
//         $pureSourceType->method('isValid')->willReturn(true);
//         $formBuilderInterface = $this->createMock(FormBuilderInterface::class);
//         $formBuilderInterface->method('getForm')->willReturn($pureSourceType);
// //         $formBuilderInterface->method('isValid')->willReturn(true);
//         $requestedActionFormBuilderService = $this->createMock(RequestedActionFormBuilderServiceInterface::class);
//         $requestedActionFormBuilderService->method('createByService')->willReturn($formBuilderInterface);
//         $requestStack = $this->createMock(RequestStack::class);
//         $requestStack->method('getCurrentRequest')->willReturn($request);
//         $layerRepositoryFactoryService = $this->createMock(LayerRepositoryFactoryServiceInterface::class);
//         $actionService = new ActionService($requestedActionService, $secureRequestedRightChecker, $requestStack, $layerRepositoryFactoryService, $requestedActionFormBuilderService, $entityManager);
//         $createSourceAction = new CreateSourceAction($actionService);
//         $result = $createSourceAction->execute();
//         $this->assertInstanceOf(PureSourceInterface::class, $result);
//     }
}
