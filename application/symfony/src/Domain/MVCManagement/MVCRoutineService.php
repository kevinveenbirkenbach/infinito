<?php

namespace Infinito\Domain\MVCManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\TemplateManagement\ActionTemplateDataStoreServiceInterface;
use Infinito\Attribut\ActionTypeAttribut;
use Infinito\DBAL\Types\ActionType;

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
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService, ActionTemplateDataStoreServiceInterface $actionTemplateDataStore)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
        $this->actionTemplateDataStore = $actionTemplateDataStore;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVCManagement\MVCRoutineServiceInterface::process()
     */
    public function process(): View
    {
        if (!$this->actionType) {
            $result = $this->actionHandlerService->handle();
            $this->actionTemplateDataStore->setData(ActionType::READ, $result);
            $view = $this->getView();

            return $view;
        }
        throw new \Exception('Not implemented yet!');
    }
}
