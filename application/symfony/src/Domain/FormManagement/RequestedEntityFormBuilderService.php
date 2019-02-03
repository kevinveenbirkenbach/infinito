<?php

namespace App\Domain\FormManagement;

use Symfony\Component\Form\FormBuilderInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;

/**
 * @author kevinfrantz
 */
final class RequestedEntityFormBuilderService implements RequestedEntityFormBuilderServiceInterface
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
     * @param FormBuilderInterface $formBuilder
     */
    public function __construct(FormBuilderInterface $formBuilder, FormClassNameServiceInterface $formClassNameService)
    {
        $this->formBuilder = $formBuilder;
        $this->formClassNameService = $formClassNameService;
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\FormManagement\EntityFormBuilderServiceInterface::create()
     */
    public function create(RequestedEntityInterface $requestedEntity): FormBuilderInterface
    {
        $origineClass = $requestedEntity->getClass();
        $class = $this->formClassNameService->getClass($origineClass);
        if ($requestedEntity->hasIdentity()) {
            $entity = $requestedEntity->getEntity();
        }
        $form = $this->formBuilder->create($class, $entity);

        return $form;
    }
}
