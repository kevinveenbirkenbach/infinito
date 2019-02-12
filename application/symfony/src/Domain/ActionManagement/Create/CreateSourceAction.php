<?php

namespace App\Domain\ActionManagement\Create;

use App\Domain\SourceManagement\SourceClassInformationService;
use App\Form\Source\SourceType;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 */
final class CreateSourceAction extends AbstractCreateAction
{
    /**
     * @var string default class name, when no parameter is defined
     */
    const DEFAULT_CLASS = AbstractSource::class;

    /**
     * @see SourceClassInformationService
     *
     * @var string The source class which should be used
     */
    private $sourceClass;

    private function setSourceClass(): void
    {
        $request = $this->actionService->getRequest();
        $this->sourceClass = $request->get(SourceType::CLASS_PARAMETER_NAME, self::DEFAULT_CLASS);
    }

    private function prepare(): void
    {
        $this->setSourceClass();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isValidByForm()
     */
    protected function isValidByForm(): bool
    {
        return $this->actionService->getCurrentFormBuilder()->getForm()->isValid();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::proccess()
     */
    protected function proccess()
    {
        $this->prepare();
    }
}
