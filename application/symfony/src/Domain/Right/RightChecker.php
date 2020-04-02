<?php

namespace Infinito\Domain\Right;

use Doctrine\Common\Collections\Collection;
use Infinito\Domain\Source\SourceMemberInformation;
use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\SourceInterface;

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
     */
    private function getAllSourcesToWhichRightApplies(): Collection
    {
        $rightSourceMemberInformation = new SourceMemberInformation($this->right->getReciever());
        $allSourcesToWhichRightApplies = clone $rightSourceMemberInformation->getAllMembers();
        $allSourcesToWhichRightApplies->add($this->right->getReciever());

        return $allSourcesToWhichRightApplies;
    }

    private function hasClientSource(SourceInterface $clientSource): bool
    {
        return $this->getAllSourcesToWhichRightApplies()->contains($clientSource);
    }

    private function isLayerEqual(string $layer): bool
    {
        return $this->right->getLayer() === $layer;
    }

    private function isTypeEqual(string $type): bool
    {
        return $this->right->getActionType() === $type;
    }

    private function checkPermission(): bool
    {
        return $this->right->getGrant();
    }

    private function doesRightApplyToAllSources(): bool
    {
        return !$this->right->hasReciever();
    }

    private function doesRightApply(SourceInterface $source): bool
    {
        return $this->doesRightApplyToAllSources() || $this->hasClientSource($source);
    }

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
