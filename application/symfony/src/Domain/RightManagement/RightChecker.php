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
        return $this->right->getCrud() === $type;
    }

    /**
     * @return bool
     */
    private function checkPermission(): bool
    {
        return $this->right->getGrant();
    }

    /**
     * @param RightInterface $right
     */
    public function __construct(RightInterface $right)
    {
        $this->right = $right;
    }

    public function isGranted(string $layer, string $type, SourceInterface $source): bool
    {
        return $this->isLayerEqual($layer) && $this->isTypeEqual($type) && $this->hasClientSource($source) && $this->checkPermission();
    }
}
