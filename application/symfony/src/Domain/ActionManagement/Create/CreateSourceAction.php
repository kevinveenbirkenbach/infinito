<?php

namespace App\Domain\ActionManagement\Create;

use App\Domain\SourceManagement\SourceClassInformationService;
use App\Form\Source\SourceType;
use App\Entity\Source\AbstractSource;
use Symfony\Component\Form\Form;

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

    /**
     * @var Form
     */
    private $form;

    private function setSourceClass(): void
    {
        $request = $this->actionService->getRequest();
        $this->sourceClass = $request->get(SourceType::CLASS_PARAMETER_NAME, self::DEFAULT_CLASS);
    }

    private function setForm(): void
    {
        $this->form = $this->actionService->getCurrentFormBuilder()->getForm();
    }

    private function setRequestedEntityClass(): void
    {
        $this->actionService->getRequestedAction()->getRequestedEntity()->setClass($this->sourceClass);
    }

    private function handleRequest(): void
    {
        $this->form->handleRequest($this->actionService->getRequest());
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::prepare()
     */
    protected function prepare(): void
    {
        $this->setSourceClass();
        $this->setRequestedEntityClass();
        $this->setForm();
        $this->handleRequest();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::isValid()
     */
    protected function isValid(): bool
    {
        //The following Exception just exists out of debuging reasons during the development process
        if (!$this->form->isSubmitted()) {
            throw new \Exception('The form is not submitted!');
        }

        return $this->form->isValid();
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\ActionManagement\AbstractAction::proccess()
     */
    protected function proccess()
    {
    }
}
