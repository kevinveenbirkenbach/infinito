<?php

namespace Infinito\Domain\MVC;

use FOS\RestBundle\View\View;
use Infinito\Attribut\ActionTypeAttribut;
use Infinito\Domain\ViewManagement\ViewServiceInterface;
use Infinito\Domain\ProcessManagement\ProcessServiceInterface;

/**
 * @author kevinfrantz
 *
 * @todo Refactor this class
 * @todo Test this class
 * @todo Rename this class and domain to something like "CoreManagement"
 */
final class MVCRoutineService implements MVCRoutineServiceInterface
{
    use ActionTypeAttribut;
    /**
     * @var ViewServiceInterface
     */
    private $viewService;

    /**
     * @var ProcessServiceInterface
     */
    private $processService;

    /**
     * @param ViewServiceInterface    $viewBuilder
     * @param ProcessServiceInterface $processService
     */
    public function __construct(ViewServiceInterface $viewBuilder, ProcessServiceInterface $processService)
    {
        $this->viewService = $viewBuilder;
        $this->processService = $processService;
    }

    /**
     * @todo Optimize the whole following function. It's just implemented like this for test reasons.
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\MVC\MVCRoutineServiceInterface::process()
     */
    public function process(): View
    {
        $data = $this->processService->process();
        $view = $this->viewService->getView();
        $view->setData($data);

        return $view;
    }
}
