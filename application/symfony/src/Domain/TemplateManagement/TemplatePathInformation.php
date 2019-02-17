<?php

namespace Infinito\Domain\TemplateManagement;

use Infinito\DBAL\Types\RESTResponseType;

/**
 * @author kevinfrantz
 *
 * @deprecated
 * @see TemplatePathService
 */
final class TemplatePathInformation implements TemplatePathInformationInterface
{
    const MOLECULE_FOLDER = 'molecule';

    const ATOM_FOLDER = 'atom';

    /**
     * @var string
     */
    private $file;

    /**
     * @see RESTResponseType::$choices
     *
     * @var string
     */
    private $type = RESTResponseType::HTML;

    /**
     * @var string
     */
    private $suffix;

    /**
     * @var string Template withouth frame
     */
    private $atomTemplatePath;

    /**
     * @var string Template with frame
     */
    private $moleculeTemplatePath;

    /**
     * @var string
     */
    private $folder;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @param string $file
     * @param string $folder
     * @param string $prefix
     */
    public function __construct(string $file, string $folder, string $prefix = '')
    {
        $this->file = $file;
        $this->folder = $folder;
        $this->prefix = $prefix;
        $this->init();
    }

    private function init(): void
    {
        $this->setPathSuffix();
        $this->setMoleculeTemplatePath();
        $this->setAtomTemplatePath();
    }

    private function setPathSuffix(): void
    {
        $this->suffix = $this->folder.'/'.$this->file.'.'.$this->type.'.twig';
    }

    private function setMoleculeTemplatePath(): void
    {
        $this->moleculeTemplatePath = self::MOLECULE_FOLDER.'/'.$this->prefix.'/'.$this->suffix;
    }

    private function setAtomTemplatePath(): void
    {
        $this->atomTemplatePath = self::ATOM_FOLDER.'/'.$this->prefix.'/'.$this->suffix;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplatePathInformationInterface::getAtomTemplatePath()
     */
    public function getAtomTemplatePath(): string
    {
        return $this->atomTemplatePath;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplatePathInformationInterface::getMoleculeTemplatePath()
     */
    public function getMoleculeTemplatePath(): string
    {
        return $this->moleculeTemplatePath;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplatePathInformationInterface::reloadType()
     */
    public function reloadType(string $type): void
    {
        $this->type = $type;
        $this->init();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TemplateManagement\TemplatePathInformationInterface::getCrud()
     */
    public function getCrud(): string
    {
        return $this->type;
    }
}
