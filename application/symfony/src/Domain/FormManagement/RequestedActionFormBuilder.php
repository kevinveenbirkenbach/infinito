<?php

namespace Infinito\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Infinito\Exception\Collection\NotSetException;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilder implements RequestedActionFormBuilderInterface
{
    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var FormClassNameServiceInterface
     */
    private $formClassNameService;

    /**
     * @param RequestedActionInterface $requestedAction
     *
     * @throws NotSetException If the requested action can't be processed
     */
    private function validateRequestedAction(RequestedActionInterface $requestedAction): void
    {
        if (!$requestedAction->hasRequestedEntity()) {
            throw new NotSetException('The <<requested entity>> attribut of a <<requested action>> must be set, to be processed by '.__CLASS__.'!');
        }
    }

    /**
     * @param FormFactoryInterface          $formFactory
     * @param FormClassNameServiceInterface $formClassNameService
     */
    public function __construct(FormFactoryInterface $formFactory, FormClassNameServiceInterface $formClassNameService)
    {
        $this->formFactory = $formFactory;
        $this->formClassNameService = $formClassNameService;
    }

    /**
     * @param RequestedActionInterface $requestedAction
     *
     * @return FormBuilderInterface
     */
    public function create(RequestedActionInterface $requestedAction): FormBuilderInterface
    {
        $this->validateRequestedAction($requestedAction);
        $requestedEntity = $requestedAction->getRequestedEntity();
        $actionType = $requestedAction->getActionType();
        $origineClass = $requestedEntity->getClass();
        $class = $this->formClassNameService->getClass($origineClass, $actionType);
        $entity = ($requestedEntity->hasIdentity()) ? $requestedEntity->getEntity() : null;
        $form = $this->formFactory->createBuilder($class, $entity);

        return $form;
    }
}
