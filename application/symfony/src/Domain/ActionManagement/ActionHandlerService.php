<?php

namespace App\Domain\ActionManagement;

/**
 * @author kevinfrantz
 */
final class ActionHandlerService implements ActionHandlerServiceInterface
{
    /**
     * @var ActionFactoryServiceInterface
     */
    private $actionFactoryService;

    /**
     * @param ActionFactoryServiceInterface $actionFactoryService
     */
    public function __construct(ActionFactoryServiceInterface $actionFactoryService)
    {
        $this->actionFactoryService = $actionFactoryService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\ActionHandlerServiceInterface::handle()
     */
    public function handle()
    {
        return $this->actionFactoryService->create()->execute();
    }
}
