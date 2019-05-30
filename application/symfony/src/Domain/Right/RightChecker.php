<?php

namespace Infinito\Domain\Right;

use Infinito\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\SourceManagement\SourceMemberInformation;

/**
 * @todo Implement the check of conditions!
 *
 * @author kevinfrantz
 */
final class RightChecker implements RightCheckerInterface
{
    /**
     * @var RightInterface
     */
    private $right;

    /**
     * @todo Implement a performant solution
     *
     * @return Collection
     */
    private function getAllSourcesToWhichRightApplies(): Collection
    {
        $rightSourceMemberInformation = new SourceMemberInformation($this->right->getReciever());
        $allSourcesToWhichRightApplies = clone $rightSourceMemberInformation->getAllMembers();
        $allSourcesToWhichRightApplies->add($this->right->getReciever());

        return $allSourcesToWhichRightApplies;
    }

    /**
     * @param SourceInterface $clientSource
     *
     * @return bool
     */
    private function hasClientSource(SourceInterface $clientSource): bool
    {
        return $this->getAllSourcesToWhichRightApplies()->contains($clientSource);
    }

    /**
     * @param string $layer
     *
     * @return bool
     */
    private function isLayerEqual(string $layer): bool
    {
        return $this->right->getLayer() === $layer;
    }

    /**
     * @param string $type
     *
     * @return bool
     */
    private function isTypeEqual(string $type): bool
    {
        return $this->right->getActionType() === $type;
    }

    /**
     * @return bool
     */
    private function checkPermission(): bool
    {
        return $this->right->getGrant();
    }

    /**
     * @return bool
     */
    private function doesRightApplyToAllSources(): bool
    {
        return !$this->right->hasReciever();
    }

    /**
     * @param SourceInterface $source
     *
     * @return bool
     */
    private function doesRightApply(SourceInterface $source): bool
    {
        return $this->doesRightApplyToAllSources() || $this->hasClientSource($source);
    }

    /**
     * @param RightInterface $right
     */
    public function __construct(RightInterface $right)
    {
        $this->right = $right;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Right\RightCheckerInterface::isGranted()
     */
    public function isGranted(string $layer, string $type, SourceInterface $source): bool
    {
        return $this->isLayerEqual($layer) && $this->isTypeEqual($type) && $this->doesRightApply($source) && $this->checkPermission();
    }
}
