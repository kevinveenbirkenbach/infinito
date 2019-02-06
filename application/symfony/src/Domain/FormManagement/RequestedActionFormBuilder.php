<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Action\RequestedActionInterface;

/**
 * @author kevinfrantz
 */
class RequestedActionFormBuilder implements RequestedActionFormBuilderInterface
{
    /**
     * @var FormBuilderInterface
     */
    private $formBuilder;

    /**
     * @var FormClassNameServiceInterface
     */
    private $formClassNameService;

    /**
     * @param FormBuilderInterface          $formBuilder
     * @param FormClassNameServiceInterface $formClassNameService
     */
    public function __construct(FormBuilderInterface $formBuilder, FormClassNameServiceInterface $formClassNameService)
    {
        $this->formBuilder = $formBuilder;
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
        $form = $this->formBuilder->create($class, $entity);

        return $form;
    }
}
