<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Infinito\Domain\ActionManagement\ActionServiceInterface;
use Infinito\Domain\ActionManagement\ActionFactoryServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\ParameterManagement\OptionalGetParameterServiceInterface;

/**
 * @author kevinfrantz
 */
final class ViewBuilder implements ViewBuilderInterface
{
    /**
     * @var string The path to the atom entity template
     */
    const TWIG_ENTITY_ATOM_TEMPLATE_PATH = 'entity/_entity.html.twig';

    /**
     * @var string The path to the molecule entity template
     */
    const TWIG_ENTITY_MOLECULE_TEMPLATE_PATH = 'entity/entity.html.twig';

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
     * @var OptionalGetParameterServiceInterface
     */
    private $optionalGetParameterService;

    /**
     * Containes the routine to decide if the template should be loaded with or without frame.
     *
     * @return bool
     */
    private function checkLoadWithFrame(): bool
    {
        if ($this->optionalGetParameterService->hasParameter(OptionalGetParameterServiceInterface::FRAME_PARAMETER)) {
            return $this->optionalGetParameterService->getParameter(OptionalGetParameterServiceInterface::FRAME_PARAMETER);
        }

        return true;
    }

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
        if ($this->checkLoadWithFrame()) {
            if ($this->templateNameService->doesMoleculeTemplateExist()) {
                return $this->templateNameService->getMoleculeTemplateName();
            }

            return self::TWIG_ENTITY_MOLECULE_TEMPLATE_PATH;
        }
        if ($this->templateNameService->doesAtomTemplateExist()) {
            return $this->templateNameService->getAtomTemplateName();
        }

        return self::TWIG_ENTITY_ATOM_TEMPLATE_PATH;
    }

    /**
     * @param ActionServiceInterface        $actionService
     * @param ActionFactoryServiceInterface $actionFactoryService
     */
    public function __construct(ActionServiceInterface $actionService, ActionFactoryServiceInterface $actionFactoryService, TemplateNameServiceInterface $templateNameService, OptionalGetParameterServiceInterface $optionalGetParameterService)
    {
        $this->view = View::create();
        $this->actionService = $actionService;
        $this->templateNameService = $templateNameService;
        $this->optionalGetParameterService = $optionalGetParameterService;
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
