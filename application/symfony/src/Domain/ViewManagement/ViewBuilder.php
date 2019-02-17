<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryService;

/**
 * @author kevinfrantz
 */
class ViewBuilder implements ViewBuilderInterface
{
    /**
     * @var View
     */
    protected $view;

    /**
     * @var RequestedActionInterface
     */
    protected $actionService;

    /**
     * @var ActionFactoryServiceInterface
     */
    protected $actionFactoryService;

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
