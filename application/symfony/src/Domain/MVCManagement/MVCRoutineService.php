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

/**
 * @author kevinfrantz
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
     * @return View
     */
    private function getView(): View
    {
        $view = View::create();
        $view->setTemplate($this->templateNameService->getMoleculeTemplateName());
        $view->setData($this->actionTemplateDataStore->getAllStoredData());

        return $view;
    }

    /**
     * @param ActionHandlerServiceInterface $actionHandlerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService, ActionTemplateDataStoreServiceInterface $actionTemplateDataStore, RequestedActionFormBuilderServiceInterface $requestedActionFormBuilderService, RequestedActionServiceInterface $requestedActionService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
        $this->actionTemplateDataStore = $actionTemplateDataStore;
        $this->requestedActionFormBuilderService = $requestedActionFormBuilderService;
        $this->requestedActionService = $requestedActionService;
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
            //UPDATE
            $this->requestedActionService->setActionType(ActionType::CREATE);
            $updateForm = $this->requestedActionFormBuilderService->createByService()->getForm()->createView();
            $this->actionTemplateDataStore->setData(ActionType::UPDATE, $updateForm);
            //READ
            $this->requestedActionService->setActionType(ActionType::READ);
            $read = $this->actionHandlerService->handle();
            $this->actionTemplateDataStore->setData(ActionType::READ, $read);
            $view = $this->getView();

            return $view;
        }
        throw new \Exception('Not implemented yet!');
    }
}
