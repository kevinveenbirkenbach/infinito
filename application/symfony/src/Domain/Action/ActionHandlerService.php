<?php

namespace Infinito\Domain\Action;

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

    public function __construct(ActionFactoryServiceInterface $actionFactoryService)
    {
        $this->actionFactoryService = $actionFactoryService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Action\ActionHandlerServiceInterface::handle()
     */
    public function handle(): ?EntityInterface
    {
        return $this->actionFactoryService->create()->execute();
    }
}
