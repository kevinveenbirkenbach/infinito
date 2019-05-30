<?php

namespace Infinito\Domain\Dom;

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
     * @return \DOMDocument
     */
    public function getDomDocument(): \DOMDocument;
}
