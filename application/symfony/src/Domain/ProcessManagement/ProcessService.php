<?php

namespace Infinito\Domain\ProcessManagement;

use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOServiceInterface;
use Infinito\Domain\ParameterManagement\ValidGetParameterServiceInterface;

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
     * @var ValidGetParameterServiceInterface
     */
    private $validGetParameterService;

    /**
     * @param ActionHandlerServiceInterface               $actionHandlerService
     * @param ActionsResultsDAOServiceInterface           $actionTemplateDataStore
     * @param RequestedActionServiceInterface             $requestedActionService
     * @param SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, ActionsResultsDAOServiceInterface $actionTemplateDataStore, RequestedActionServiceInterface $requestedActionService, SecureRequestedRightCheckerServiceInterface $secureRequestedRightCheckerService, ValidGetParameterServiceInterface $validGetParameterService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->actionsResultsDAOService = $actionTemplateDataStore;
        $this->requestedActionService = $requestedActionService;
        $this->secureRequestedRightCheckerService = $secureRequestedRightCheckerService;
        $this->validGetParameterService = $validGetParameterService;
    }

    /**
     * @todo Move
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ProcessManagement\ProcessServiceInterface::process()
     */
    public function process()
    {
        $result = null;
        $actionType = $this->requestedActionService->getActionType();
        if ($this->requestedActionService->hasRequestedEntity() && $this->requestedActionService->getRequestedEntity()->hasIdentity()) {
            // READ UPDATE DELETE EXECUTE
            if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                $result = $this->actionHandlerService->handle();
            }
        } else {
            // CREATE
            $this->requestedActionService->getRequestedEntity()->setClass(TextSource::class);
        }
        $this->actionsResultsDAOService->setData($actionType, $result);

        return $this->actionsResultsDAOService;
    }
}
