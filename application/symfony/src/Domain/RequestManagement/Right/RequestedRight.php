<?php

namespace App\Domain\RequestManagement\Right;

use App\Entity\Source\SourceInterface;
use App\Attribut\CrudAttribut;
use App\Attribut\LayerAttribut;
use App\Attribut\RecieverAttribut;
use App\Exception\PreconditionFailedException;
use App\Exception\NotSetException;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Attribut\RequestedEntityAttribut;
use App\Entity\Meta\MetaInterface;
use App\Exception\NotCorrectInstanceException;

/**
 * @author kevinfrantz
 *
 * @todo Check out if the performance of this class can be optimized!
 */
class RequestedRight implements RequestedRightInterface
{
    use CrudAttribut, LayerAttribut, RecieverAttribut, RequestedEntityAttribut;

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var RequestedEntityInterface
     */
    private $requestedEntity;

    /**
     * @throws NotCorrectInstanceException
     */
    private function loadSource(): void
    {
        $entity = $this->requestedEntity->getEntity();
        if ($entity instanceof SourceInterface) {
            $this->source = $entity;
        }
        if ($entity instanceof MetaInterface) {
            $this->source = $entity->getSource();
        }
        throw new NotCorrectInstanceException('The entity instance can\'t be processed');
    }

    /**
     * @throws PreconditionFailedException If the source has no id or slug
     */
    private function validateRequestedEntity(): void
    {
        if ($this->requestedEntity->hasSlug() || $this->requestedEntity->hasId()) {
            return;
        }
        throw new PreconditionFailedException(get_class($this->requestedEntity).' needs to have a defined attribut id or slug!');
    }

    /**
     * Uses some kind of Lazy loading.
     *
     * @see https://en.wikipedia.org/wiki/Lazy_loading
     * {@inheritdoc}
     * @see \App\Domain\RequestManagement\Right\RequestedRightInterface::getSource()
     */
    final public function getSource(): SourceInterface
    {
        $this->validateRequestedEntity();
        $this->loadSource();
        $this->validateLoad();

        return $this->source;
    }

    private function validateLoad(): void
    {
        if ($this->source) {
            return;
        }
        throw new NotSetException('The Requested Source couldn\'t be found!');
    }

    /**
     * Overriding is neccessary to declare the correct relation.
     *
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Right\RequestedRightInterface::setRequestedEntity()
     */
    final public function setRequestedEntity(RequestedEntityInterface $requestedEntity): void
    {
        $this->requestedEntity = $requestedEntity;
        if ($requestedEntity->getRequestedRight() !== $this) {
            $this->requestedEntity->setRequestedRight($this);
        }
    }
}
