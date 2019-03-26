<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryServiceInterface;

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
     * @param ActionServiceInterface        $actionService
     * @param ActionFactoryServiceInterface $actionFactoryService
     */
    public function __construct(ActionServiceInterface $actionService, ActionFactoryServiceInterface $actionFactoryService)
    {
        $this->view = new View();
        $this->actionService = $actionService;
    }

    /**
     * @return View
     */
    public function getView(): View
    {
        $view = View::create();
        $view->setTemplate(self::TWIG_ENTITY_TEMPLATE_PATH);

        return $view;
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
