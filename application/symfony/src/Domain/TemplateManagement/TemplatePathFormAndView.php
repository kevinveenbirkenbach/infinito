<?php

namespace src\Domain\TemplateManagement;

use App\Domain\TemplateManagement\TemplatePathFormAndViewInterface;
use App\Domain\TemplateManagement\TemplatePathInformation;
use App\Domain\TemplateManagement\TemplatePathInformationInterface;
use App\Domain\FormManagement\FormMeta;

/**
 * @author kevinfrantz
 */
final class TemplatePathFormAndView implements TemplatePathFormAndViewInterface
{
    const FORM_FOLDER = FormMeta::FOLDER;

    const VIEW_FOLDER = 'view';

    /**
     * @var TemplatePathInformation
     */
    private $form;

    /**
     * @var TemplatePathInformation
     */
    private $view;

    /**
     * @param string $file
     * @param string $folder
     * @param string $type
     */
    public function __construct(string $file, string $folder)
    {
        $this->setForm($file, $folder);
        $this->setView($file, $folder);
    }

    /**
     * @param string $file
     * @param string $folder
     */
    private function setForm(string $file, string $folder): void
    {
        $this->form = new TemplatePathInformation($file, $folder, self::FORM_FOLDER);
    }

    /**
     * @param string $file
     * @param string $folder
     */
    private function setView(string $file, string $folder): void
    {
        $this->view = new TemplatePathInformation($file, $folder, $type, self::VIEW_FOLDER);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\TemplateManagement\TemplatePathFormAndViewInterface::getForm()
     */
    public function getForm(): TemplatePathInformationInterface
    {
        return $this->form;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\TemplateManagement\TemplatePathFormAndViewInterface::getView()
     */
    public function getView(): TemplatePathInformation
    {
        return $this->view;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\TemplateManagement\ReloadTypeInterface::reloadType()
     */
    public function reloadType(string $type): void
    {
        $this->view->reloadType($type);
        $this->form->reloadType($type);
    }
}
