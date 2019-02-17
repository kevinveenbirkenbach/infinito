<?php

namespace Infinito\Domain\MVCManagement;

use FOS\RestBundle\View\View;
use Infinito\Entity\EntityInterface;
use Infinito\Domain\ActionManagement\ActionHandlerServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;

/**
 * @author kevinfrantz
 */
final class MVCRoutineService implements MVCRoutineServiceInterface
{
    /**
     * @var ActionHandlerServiceInterface
     */
    private $actionHandlerService;

    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * @param EntityInterface[]|EntityInterface|null $result
     *
     * @return array Well formated data for view
     */
    private function getViewData($result): array
    {
        switch (gettype($result)) {
            case 'object':
                return ['entity' => $result];
            case 'array':
                return ['entities' => $result];
            case 'null':
                return [];
        }
    }

    /**
     * @param ActionHandlerServiceInterface $actionHandlerService
     */
    public function __construct(ActionHandlerServiceInterface $actionHandlerService, TemplateNameServiceInterface $templateNameService)
    {
        $this->actionHandlerService = $actionHandlerService;
        $this->templateNameService = $templateNameService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVCManagement\MVCRoutineServiceInterface::process()
     */
    public function process(): View
    {
        $result = $this->actionHandlerService->handle();
        $data = $this->getViewData($result);
        $view = $this->getView($data);

        return $view;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVCManagement\MVCRoutineServiceInterface::getView()
     */
    public function getView(array $data): View
    {
        $view = View::create();
        $view->setTemplate($this->templateNameService->getMoleculeTemplateName());
        $view->setData($data);

        return $view;
    }
}
