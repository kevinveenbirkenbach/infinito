<?php

namespace Infinito\Domain\ProcessManagement;

use Infinito\DBAL\Types\ActionType;
use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOServiceInterface;

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
     * @var ActionsResultsDAOServiceInterface
     */
    private $actionsResultsDAOService;

    /**
     * @param ActionHandlerServiceInterface               $actionHandlerService
     * @param ActionsResultsDAOServiceInterface           $actionTemplateDataStore
     * @param RequestedActionServiceInterface             $requestedActionService
     * @param SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, ActionsResultsDAOServiceInterface $actionTemplateDataStore, RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->actionsResultsDAOService = $actionTemplateDataStore;
        $this->requestedActionService = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightCheckerService;
    }

    /**
     * @todo Move
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ProcessManagement\ProcessServiceInterface::process()
     */
    public function process()
    {
        if ($this->requestedActionService->hasRequestedEntity() && $this->requestedActionService->getRequestedEntity()->hasIdentity()) {
            // READ VIEW
            if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                $read = $this->actionHandlerService->handle();
                $this->actionsResultsDAOService->setData(ActionType::READ, $read);
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
            $this->actionsResultsDAOService->setData(ActionType::CREATE, null);
        }

        return $this->actionsResultsDAOService;
    }
}
