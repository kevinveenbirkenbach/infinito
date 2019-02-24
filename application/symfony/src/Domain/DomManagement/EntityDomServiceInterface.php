<?php

namespace Infinito\Domain\DomManagement;

use Infinito\Entity\EntityInterface;

/**
 * Allows to build a DOM for an entity.
 *
 * @see https://de.wikipedia.org/wiki/Document_Object_Model
 *
 * @author kevinfrantz
 */
interface EntityDomServiceInterface
{
    /**
     * @param EntityInterface $entity
     *
     * @return \DOMDocument
     */
    public function getDomDocument(EntityInterface $entity): \DOMDocument;
}
