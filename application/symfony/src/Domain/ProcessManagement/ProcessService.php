<?php

namespace Infinito\Domain\ProcessManagement;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Domain\FormManagement\RequestedActionFormBuilderServiceInterface;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 */
final class ProcessService implements ProcessServiceInterface
{
    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @var SecureRequestedRightCheckerServiceInterface
     */
    private $secureRequestedRightCheckerService;

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
     * @param ActionHandlerServiceInterface               $actionHandlerService
     * @param TemplateNameServiceInterface                $templateNameService
     * @param ActionTemplateDataStoreServiceInterface     $actionTemplateDataStore
     * @param RequestedActionFormBuilderServiceInterface  $requestedActionFormBuilderService
     * @param RequestedActionServiceInterface             $requestedActionService
     * @param SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService, ActionTemplateDataStoreServiceInterface $actionTemplateDataStore, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
        $this->actionTemplateDataStore = $actionTemplateDataStore;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
        $this->requestedActionService = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightCheckerService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ProcessManagement\ProcessServiceInterface::process()
     */
    public function process(): void
    {
        if ($this->requestedActionService->hasRequestedEntity() && $this->requestedActionService->getRequestedEntity()->hasIdentity()) {
            // READ VIEW
            // $this->requestedActionService->setActionType(ActionType::READ);
            if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                $read = $this->actionHandlerService->handle();
                $this->actionTemplateDataStore->setData(ActionType::READ, $read);
            }
            // $this->requestedActionService->setActionType(ActionType::UPDATE);
            // UPDATE VIEW
            // if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
            // $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
            // $this->actionTemplateDataStore->setData(ActionType::UPDATE, $updateForm);
            // }
            // DELETE VIEW
            // EXECUTE VIEW
        } else {
            // CREATE
            $this->requestedActionService->getRequestedEntity()->setClass(TextSource::class);
            $updateForm = $this->requestedActionFormBuilderService->createByService()
                ->getForm()
                ->createView();
            $this->actionTemplateDataStore->setData(ActionType::CREATE, $updateForm);
        }
    }
}
