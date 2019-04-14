<?php

namespace Infinito\Domain\ProcessManagement;

use Infinito\Domain\RequestManagement\Action\RequestedActionServiceInterface;
use Infinito\Domain\SecureManagement\SecureRequestedRightCheckerServiceInterface;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Entity\Source\Primitive\Text\TextSource;
use Infinito\Domain\DataAccessManagement\ActionsResultsDAOServiceInterface;
use Infinito\Domain\ParameterManagement\ValidGetParameterServiceInterface;
use Symfony\Component\Finder\Exception\AccessDeniedException;

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
     * @return bool True if the the entity exist
     */
    private function doesEntityExist(): bool
    {
        $requestedAction = $this->requestedActionService;

        return $requestedAction->hasRequestedEntity() && $requestedAction->getRequestedEntity()->hasIdentity();
    }

    /**
     * @return mixed|null
     *
     * @throws AccessDeniedException
     */
    private function getResult()
    {
        if ($this->doesEntityExist()) {
            // READ UPDATE DELETE EXECUTE
            if ($this->secureRequestedRightCheckerService->check($this->requestedActionService)) {
                return $this->actionHandlerService->handle();
            }
            throw new AccessDeniedException("The user doesn't have the permission to access this page!");
        }
        // CREATE
        $this->requestedActionService->getRequestedEntity()->setClass(TextSource::class);

        return;
    }

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
        $result = $this->getResult();
        $actionType = $this->requestedActionService->getActionType();
        $this->actionsResultsDAOService->setData($actionType, $result);

        return $this->actionsResultsDAOService;
    }
}
