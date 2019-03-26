<?php

namespace Infinito\Domain\MVCManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface;
use Infinito\Attribut\ActionTypeAttribut;
use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\ViewManagement\ViewBuilderInterface;

/**
 * @author kevinfrantz
 *
 * @todo Refactor this class
 * @todo Test this class
 */
final class MVCRoutineService implements MVCRoutineServiceInterface
{
    use ActionTypeAttribut;

    /**
     * @var ActionHandlerServiceInterface
     */
    private $actionHandlerService;

    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * @var ActionTemplateDataStoreServiceInterface
     */
    private $actionTemplateDataStore;

    /**
     * @var RequestedActionFormBuilderServiceInterface
     */
    private $requestedActionFormBuilderService;

    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

    /**
     * @var ViewBuilderInterface
     */
    private $viewBuilder;

    /**
     * @param ActionHandlerServiceInterface               $actionHandlerService
     * @param TemplateNameServiceInterface                $templateNameService
     * @param ActionTemplateDataStoreServiceInterface     $actionTemplateDataStore
     * @param RequestedActionFormBuilderServiceInterface  $requestedActionFormBuilderService
     * @param RequestedActionServiceInterface             $requestedActionService
     * @param SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService
     * @param ViewBuilderInterface                        $viewBuilder
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService, ActionTemplateDataStoreServiceInterface $actionTemplateDataStore, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService, ViewBuilderInterface $viewBuilder)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
        $this->actionTemplateDataStore = $actionTemplateDataStore;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
        $this->requestedActionService = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightCheckerService;
        $this->viewBuilder = $viewBuilder;
    }

    /**
     * @todo Optimize the whole following function. It's just implemented like this for test reasons.
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVCManagement\MVCRoutineServiceInterface::process()
     */
    public function process(): View
    {
        if (!$this->actionType) {
            if ($this->requestedActionService->hasRequestedEntity() && $this->requestedActionService->getRequestedEntity()->hasIdentity()) {
                //READ VIEW
//                 $this->requestedActionService->setActionType(ActionType::READ);
                if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                    $read = $this->actionHandlerService->handle();
                    $this->actionTemplateDataStore->setData(ActionType::READ, $read);
                }
//                 $this->requestedActionService->setActionType(ActionType::UPDATE);
                //UPDATE VIEW
//                 if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
//                     $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
//                     $this->actionTemplateDataStore->setData(ActionType::UPDATE, $updateForm);
//                 }
                //DELETE VIEW
                //EXECUTE VIEW
            } else {
                //CREATE
                $this->requestedActionService->getRequestedEntity()->setClass(TextSource::class);
                $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
                $this->actionTemplateDataStore->setData(ActionType::CREATE, $updateForm);
            }

            return $this->viewBuilder->getView();
        }
        throw new \Exception('Not implemented yet!');
    }
}
