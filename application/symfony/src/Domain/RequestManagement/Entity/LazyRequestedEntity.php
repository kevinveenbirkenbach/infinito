<?php

namespace Infinito\Domain\RequestManagement\Entity;

use Infinito\Entity\EntityInterface;
use Infinito\Attribut\SlugAttributInterface;

/**
 * This class allows to use the RequestedEntity via LazyLoading
 * It reduce the ammount of requests which are send to the database.
 *
 * @author kevinfrantz
 */
class LazyRequestedEntity extends RequestedEntity
{
    /**
     * @var EntityInterface|null Important for lazy loading
     */
    private static $lazyLoadedEntity;

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\RequestManagement\Entity\RequestedEntity::loadEntity()
     */
    protected function loadEntity(): ?EntityInterface
    {
        return $this->lazyLoadEntity();
    }

    /**
     * @return EntityInterface|null
     */
    private function lazyLoadEntity(): ?EntityInterface
    {
        if ($this->isLazyLoadNeccessary()) {
            $entity = parent::loadEntity();
            self::$lazyLoadedEntity = $entity;
        }

        return self::$lazyLoadedEntity;
    }

    /**
     * @return bool
     */
    private function isLazyLoadNeccessary(): bool
    {
        if (self::$lazyLoadedEntity) {
            if ($this->hasId()) {
                return $this->id !== self::$lazyLoadedEntity->getId();
            }
            if ($this->hasSlug()) {
                if (self::$lazyLoadedEntity instanceof SlugAttributInterface) {
                    return $this->slug !== self::$lazyLoadedEntity->getSlug();
                }
            }
        }

        return true;
    }
}
