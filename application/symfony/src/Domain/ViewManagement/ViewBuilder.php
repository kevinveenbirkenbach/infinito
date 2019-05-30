<?php

namespace Infinito\Domain\ViewManagement;

use FOS\RestBundle\View\View;
use Infinito\Domain\Action\ActionFactoryServiceInterface;
use Infinito\Domain\TemplateManagement\TemplateNameServiceInterface;
use Infinito\Domain\ParameterManagement\ValidGetParameterServiceInterface;
use Infinito\Domain\ParameterManagement\Parameter\FrameParameter;

/**
 * @author kevinfrantz
 */
final class ViewBuilder implements ViewServiceInterface
{
    /**
     * @var string The path to the atom entity template
     */
    private const TWIG_ENTITY_ATOM_TEMPLATE_PATH = 'entity/_entity.html.twig';

    /**
     * @var string The path to the molecule entity template
     */
    private const TWIG_ENTITY_MOLECULE_TEMPLATE_PATH = 'entity/entity.html.twig';

    /**
     * @var View
     */
    private $view;

    /**
     * @var ActionFactoryServiceInterface
     */
    private $actionFactoryService;

    /**
     * @var TemplateNameServiceInterface
     */
    private $templateNameService;

    /**
     * @var ValidGetParameterServiceInterface
     */
    private $validGetParameterService;

    /**
     * Containes the routine to decide if the template should be loaded with or without frame.
     *
     * @return bool
     */
    private function checkLoadWithFrame(): bool
    {
        if ($this->validGetParameterService->hasParameter(FrameParameter::getKey())) {
            return $this->validGetParameterService->getParameter(FrameParameter::getKey());
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
     * @param ActionFactoryServiceInterface     $actionFactoryService
     * @param TemplateNameServiceInterface      $templateNameService
     * @param ValidGetParameterServiceInterface $validGetParameterService
     */
    public function __construct(ActionFactoryServiceInterface $actionFactoryService, TemplateNameServiceInterface $templateNameService, ValidGetParameterServiceInterface $validGetParameterService)
    {
        $this->view = View::create();
        $this->templateNameService = $templateNameService;
        $this->validGetParameterService = $validGetParameterService;
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
}
