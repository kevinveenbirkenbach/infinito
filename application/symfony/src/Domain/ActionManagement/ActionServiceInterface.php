<?php

namespace App\Domain\ActionManagement;

use App\Domain\RequestManagement\Action\RequestedActionInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use App\Entity\EntityInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * This interface offers all classes for managing an Action.
 *
 * @author kevinfrantz
 */
interface ActionServiceInterface
{
    /**
     * @return RequestedActionInterface Returns the requested action
     */
    public function getRequestedAction(): RequestedActionInterface;

    /**
     * @return bool true if the action permissions are right
     */
    public function isRequestedActionSecure(): bool;

    /**
     * @return Request
     */
    public function getRequest(): Request;

    /**
     * @return RepositoryInterface
     */
    public function getRepository(): RepositoryInterface;

    /**
     * @param EntityInterface $entity
     *
     * @return FormBuilderInterface
     */
    public function getForm(EntityInterface $entity): FormBuilderInterface;

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}
