<?php

namespace App\Domain\RequestManagement;

use App\Entity\Source\SourceInterface;
use App\Entity\Attribut\TypeAttribut;
use App\Entity\Attribut\LayerAttribut;
use App\Entity\Attribut\RecieverAttribut;
use App\Exception\PreconditionFailedException;
use App\Exception\NotSetException;
use App\Repository\Source\SourceRepositoryInterface;

/**
 * @author kevinfrantz
 *
 * @todo Check out if the performance of this class can be optimized!
 */
class RequestedRight implements RequestedRightInterface
{
    use TypeAttribut, LayerAttribut, RecieverAttribut;

    /**
     * @var SourceRepositoryInterface
     */
    private $sourceRepository;

    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @var RequestedSourceInterface
     */
    private $requestedSource;

    /**
     * @param SourceRepositoryInterface $sourceRepository
     */
    public function __construct(SourceRepositoryInterface $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    private function loadSource(): void
    {
        $this->source = $this->sourceRepository->findOneByIdOrSlug($this->requestedSource);
    }

    /**
     * @throws PreconditionFailedException If the source has no id or slug
     */
    private function validateRequestedSource(): void
    {
        if ($this->requestedSource->hasSlug() || $this->requestedSource->hasId()) {
            return;
        }
        throw new PreconditionFailedException(get_class($this->requestedSource).' needs to have a defined attribut id or slug!');
    }

    /**
     * Uses some kind of Lazy loading.
     *
     * @see https://en.wikipedia.org/wiki/Lazy_loading
     * {@inheritdoc}
     * @see \App\Domain\RequestManagement\RequestedRightInterface::getSource()
     */
    final public function getSource(): SourceInterface
    {
        $this->validateRequestedSource();
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
     * @see \App\Domain\RequestManagement\RequestedRightInterface::setRequestedSource()
     */
    final public function setRequestedSource(RequestedSourceInterface $requestedSource)
    {
        $this->requestedSource = $requestedSource;
    }
}
