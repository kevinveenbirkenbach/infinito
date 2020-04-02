<?php

namespace Infinito\Domain\Action;

use Doctrine\ORM\EntityManagerInterface;
use Infinito\Domain\Request\Action\RequestedActionInterface;
use Infinito\Repository\RepositoryInterface;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;

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

    public function getRequest(): Request;

    public function getRepository(): RepositoryInterface;

    public function getCurrentFormBuilder(): FormBuilderInterface;

    public function getEntityManager(): EntityManagerInterface;
}
