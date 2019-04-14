<?php

namespace Infinito\Domain\ActionManagement;

use Infinito\Domain\RequestManagement\Action\RequestedActionInterface;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * This interface offers all classes for managing an Action.
 *
 * @author kevinfrantz
 */
interface ActionDependenciesDAOServiceInterface
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
     * @return FormBuilderInterface
     */
    public function getCurrentFormBuilder(): FormBuilderInterface;

    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface;
}
