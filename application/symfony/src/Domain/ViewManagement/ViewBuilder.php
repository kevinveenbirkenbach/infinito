<?php

namespace App\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use App\Domain\ActionManagement\ActionServiceInterface;
use App\Domain\ActionManagement\ActionFactoryServiceInterface;
use App\Domain\ActionManagement\ActionFactoryService;

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
     * @see \App\Domain\ViewManagement\ViewBuilderInterface::getActionService()
     */
    public function getActionService(): ActionServiceInterface
    {
        return $this->actionService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ViewManagement\ViewBuilderInterface::build()
     */
    public function build(): void
    {
        $this->view->create();
    }
}
