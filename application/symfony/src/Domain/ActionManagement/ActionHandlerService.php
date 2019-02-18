<?php

namespace Infinito\Domain\ActionManagement;

use Infinito\Entity\EntityInterface;

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
     * @see \Infinito\Domain\ActionManagement\ActionHandlerServiceInterface::handle()
     */
    public function handle(): ?EntityInterface
    {
        return $this->actionFactoryService->create()->execute();
    }
}
