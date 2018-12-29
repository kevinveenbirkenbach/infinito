<?php

namespace App\Domain\RightManagement;

use App\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberInformation;

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
        return $this->right->getType() === $type;
    }

    private function checkPermission(): bool
    {
        return $this->right->getGrant();
    }

    public function __construct(RightInterface $right)
    {
        $this->right = $right;
    }

    public function isGranted(string $layer, string $type, SourceInterface $source): bool
    {
        return $this->isLayerEqual($layer) && $this->isTypeEqual($type) && $this->hasClientSource($source) && $this->checkPermission();
    }
}
