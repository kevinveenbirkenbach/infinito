<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;

/**
 * @author kevinfrantz
 */
final class ViewBuilder implements ViewBuilderInterface
{
    /**
     * @var View
     */
    private $view;

    /**
     * @var RequestedActionInterface
     */
    private $actionService;

    /**
     * @var ActionFactoryServiceInterface
     */
    private $actionFactoryService;

    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * Don't know if this function will be usefull in the future.
     * Feel free to remove it if this should not be the case.
     *
     * @todo Implement tests
     *
     * @return string The general entity template or a individual template if it is set
     */
    private function getTemplate(): string
    {
        if ($this->templateNameService->doesMoleculeTemplateExist()) {
            return $this->templateNameService->getMoleculeTemplateName();
        }

        return self::TWIG_ENTITY_TEMPLATE_PATH;
    }

    /**
     * @param ActionServiceInterface        $actionService
     * @param ActionFactoryServiceInterface $actionFactoryService
     */
    public function __construct(ActionServiceInterface $actionService, ActionFactoryServiceInterface $actionFactoryService, TemplateNameServiceInterface $templateNameService)
    {
        $this->view = View::create();
        $this->actionService = $actionService;
        $this->templateNameService = $templateNameService;
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        $template = $this->getTemplate();
        $this->view->setTemplate($template);

        return $this->view;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ViewManagement\ViewBuilderInterface::getActionService()
     */
    public function getActionService(): ActionServiceInterface
    {
        return $this->actionService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ViewManagement\ViewBuilderInterface::build()
     */
    public function build(): void
    {
        $this->view->create();
    }
}
