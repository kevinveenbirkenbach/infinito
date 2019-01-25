<?php

namespace App\Domain\FormManagement;

use App\Entity\EntityInterface;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author kevinfrantz
 */
final class EntityFormBuilderService implements EntityFormBuilderServiceInterface
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
    public function create(EntityInterface $entity): FormBuilderInterface
    {
        $class = $this->formClassNameService->getName($entity);
        $form = $this->formBuilder->create($class, $entity);

        return $form;
    }
}
