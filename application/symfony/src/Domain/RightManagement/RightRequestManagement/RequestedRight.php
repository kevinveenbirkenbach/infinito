<?php

namespace App\Domain\RightManagement\RightRequestManagement;

use Doctrine\ORM\EntityManager;
use App\Repository\Source\SourceRepository;
use App\Domain\SourceManagement\RequestedSourceInterface;
use App\Entity\Source\SourceInterface;
use App\Entity\Attribut\TypeAttribut;
use App\Entity\Attribut\LayerAttribut;
use App\Entity\Attribut\RecieverAttribut;

/**
 * @author kevinfrantz
 */
class RequestedRight implements RequestedRightInterface
{
    use TypeAttribut, LayerAttribut, RecieverAttribut;

    /**
     * @var SourceRepository
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
     * @param EntityManager $entityManager
     */
    public function __construct(SourceRepository $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    private function loadSource(): void
    {
        $this->source = $this->sourceRepository->findOneByIdOrSlug($this->requestedSource);
    }

    /**
     * @return bool
     */
    private function isIdEquals(): bool
    {
        if (!$this->requestedSource->hasId() || !$this->source->hasId()) {
            return false;
        }

        return $this->requestedSource->getId() === $this->source->getId();
    }

    /**
     * @return bool
     */
    private function isSlugEquals(): bool
    {
        if (!$this->requestedSource->hasSlug() || !$this->source->hasSlug()) {
            return false;
        }

        return $this->requestedSource->getSlug() === $this->source->getSlug();
    }

    /**
     * @return bool Returns true if the source is not set!
     */
    private function isSourceNotSet(): bool
    {
        return !isset($this->source);
    }

    /**
     * @return bool Tells if a reload of the source is neccessary
     */
    private function isReloadNeccessary(): bool
    {
        return $this->isSourceNotSet() || $this->isIdEquals() || $this->isSlugEquals();
    }

    /**
     * Uses some kind of Lazy loading.
     *
     * @see https://en.wikipedia.org/wiki/Lazy_loading
     * {@inheritdoc}
     * @see \App\Domain\RightManagement\RightRequestManagement\RequestedRightInterface::getSource()
     */
    final public function getSource(): SourceInterface
    {
        if ($this->isReloadNeccessary()) {
            $this->loadSource();
            $this->setSourceIfNotSet();
        }

        return $this->source;
    }

    private function setSourceIfNotSet(): void
    {
        if (!isset($this->source)) {
            $this->source = $this->requestedSource;
        }
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RightManagement\RightRequestManagement\RequestedRightInterface::setRequestedSource()
     */
    final public function setRequestedSource(RequestedSourceInterface $requestedSource)
    {
        $this->requestedSource = $requestedSource;
    }
}
