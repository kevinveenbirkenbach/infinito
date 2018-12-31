<?php

namespace App\Controller;

use App\Entity\EntityInterface;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * @todo Check which of the as deprecated declared functions make sense to remove
 *
 * @author kevinfrantz
 */
abstract class AbstractEntityController extends FOSRestController
{
    /**
     * @deprecated
     *
     * @var string
     */
    protected $entityName;

    /**
     * @deprecated
     */
    public function __construct()
    {
        $this->setEntityName();
    }

    /**
     * @deprecated
     */
    abstract protected function setEntityName(): void;

    /**
     * @deprecated
     *
     * @param int $id
     *
     * @return EntityInterface
     */
    protected function loadEntityById(int $id): EntityInterface
    {
        $entity = $this->getDoctrine()
        ->getRepository($this->entityName)
        ->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('No entity found for id '.$id);
        }

        return $entity;
    }

    /**
     * @deprecated
     *
     * @param string $slug
     *
     * @return EntityInterface
     */
    protected function loadEntityBySlug(string $slug): EntityInterface
    {
        $entity = $this->getDoctrine()
        ->getRepository($this->entityName)
        ->findOneBy(['slug' => $slug]);
        if (!$entity) {
            throw $this->createNotFoundException('No entity found for slug '.$slug);
        }

        return $entity;
    }

    /**
     * @deprecated
     *
     * @param string $route
     * @param int    $id
     *
     * @return RedirectResponse
     */
    protected function redirectToRouteById(string $route, int $id): RedirectResponse
    {
        return $this->redirectToRoute($route, [
            'id' => $id,
        ]);
    }
}
