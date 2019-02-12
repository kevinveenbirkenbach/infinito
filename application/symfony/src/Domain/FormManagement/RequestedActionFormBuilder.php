<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;
use Symfony\Component\Form\FormFactoryInterface;

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
     * @param FormFactoryInterface $formFactory
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
        $requestedEntity = $requestedAction->getRequestedEntity();
        $actionType = $requestedAction->getActionType();
        $origineClass = $requestedEntity->getClass();
        $class = $this->formClassNameService->getClass($origineClass, $actionType);
        if ($requestedEntity->hasIdentity()) {
            $entity = $requestedEntity->getEntity();
        }
        $form = $this->formFactory->createBuilder($class, $entity);

        return $form;
    }
}
