<?php

namespace App\Domain\RequestManagement\Right;

use App\Entity\Source\SourceInterface;
use App\Attribut\CrudAttribut;
use App\Attribut\LayerAttribut;
use App\Attribut\RecieverAttribut;
use App\Exception\PreconditionFailedException;
use App\Exception\NotSetException;
use App\Repository\Source\SourceRepositoryInterface;
use App\Domain\RequestManagement\Entity\RequestedEntityInterface;
use App\Attribut\RequestedEntityAttribut;

/**
 * @author kevinfrantz
 *
 * @todo Check out if the performance of this class can be optimized!
 */
class RequestedRight implements RequestedRightInterface
{
    use CrudAttribut, LayerAttribut, RecieverAttribut, RequestedEntityAttribut;

    /**
     * @var SourceRepositoryInterface
     */
    private $sourceRepository;

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var RequestedEntityInterface
     */
    private $requestedEntity;

    /**
     * @param SourceRepositoryInterface $sourceRepository
     */
    public function __construct(SourceRepositoryInterface $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    private function loadSource(): void
    {
        $this->source = $this->sourceRepository->findOneByIdOrSlug($this->requestedEntity);
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
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Right\RequestedRightInterface::setRequestedEntity()
     */
    final public function setRequestedEntity(RequestedEntityInterface $requestedSource): void
    {
        $this->requestedEntity = $requestedSource;
    }
}