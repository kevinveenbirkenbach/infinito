<?php

namespace Infinito\Domain\TemplateManagement;

use Infinito\Domain\Request\Action\RequestedActionServiceInterface;

/**
 * @author kevinfrantz
 */
class TemplateNameService implements TemplateNameServiceInterface
{
    /**
     * @var string
     */
    const BASE_TEMPLATE_DIR = __DIR__.'/../../../templates/';

    /**
     * @var string The namespace which should be ignored
     */
    const BASE_NAMESPACE = 'Infinito\\Entity';

    /**
     * @var string the basic entry point for templates
     */
    const BASE_ENTITY_TEMPLATE_FOLDER = 'entity';

    /**
     * @var string
     */
    const MOLECULE_PRAEFFIX = '';

    /**
     * @var string
     */
    const ATOM_PRAEFFIX = '_';

    /**
     * @var string
     */
    const TWIG_SUFFIX = '.html.twig';

    /**
     * @var RequestedActionServiceInterface
     */
    private $requestedActionService;

    /**
     * @return string
     */
    protected function getActionType(): string
    {
        return $this->requestedActionService->getActionType();
    }

    /**
     * @return string
     */
    protected function getClass(): string
    {
        return $this->requestedActionService->getRequestedEntity()->getClass();
    }

    /**
     * @param RequestedActionServiceInterface $requestedActionService
     */
    public function __construct(RequestedActionServiceInterface $requestedActionService)
    {
        $this->requestedActionService = $requestedActionService;
    }

    /**
     * @return string
     */
    private function getBasePath(): string
    {
        $origineClass = $this->getClass();
        $baseReplaced = str_replace(self::BASE_NAMESPACE, self::BASE_ENTITY_TEMPLATE_FOLDER, $origineClass);
        $elements = explode('\\', $baseReplaced);
        array_pop($elements); // Removes class name
        $templatePath = implode('/', $elements);
        $lowerCasePath = strtolower($templatePath);

        return $lowerCasePath.'/';
    }

    /**
     * @return string the short class name in lower cases
     */
    private function getShortName(): string
    {
        $origineClass = $this->getClass();
        $elements = explode('\\', $origineClass);
        $class = $elements[count($elements) - 1];
        $lcFirst = lcfirst($class);
        $bigLettersSubstituted = preg_replace('/([A-Z])/', '_$1', $lcFirst);
        $lowerCase = strtolower($bigLettersSubstituted);

        return $lowerCase;
    }

    /**
     * @return string
     */
    private function getActionSuffix(): string
    {
        return '_'.strtolower($this->getActionType());
    }

    /**
     * @param string $type
     *
     * @return string
     */
    private function getTemplatePath(?string $type): string
    {
        return $this->getBasePath().$type.$this->getShortName().$this->getActionSuffix().self::TWIG_SUFFIX;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplateNameServiceInterface::getAtomTemplateName()
     */
    public function getAtomTemplateName(): string
    {
        return $this->getTemplatePath(self::ATOM_PRAEFFIX);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplateNameServiceInterface::getMoleculeTemplateName()
     */
    public function getMoleculeTemplateName(): string
    {
        return $this->getTemplatePath(self::MOLECULE_PRAEFFIX);
    }

    /**
     * @param string $template
     *
     * @return bool
     */
    private function templateExists(string $template): bool
    {
        return file_exists(self::BASE_TEMPLATE_DIR.$template);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplateNameServiceInterface::doesAtomTemplateExists()
     */
    public function doesAtomTemplateExist(): bool
    {
        return $this->templateExists($this->getAtomTemplateName());
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplateNameServiceInterface::doesMoleculeTemplateExists()
     */
    public function doesMoleculeTemplateExist(): bool
    {
        return $this->templateExists($this->getMoleculeTemplateName());
    }
}
