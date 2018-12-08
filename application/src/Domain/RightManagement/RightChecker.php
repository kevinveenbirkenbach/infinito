<?php

namespace App\Domain\RightManagement;

use App\Entity\Meta\RightInterface;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use App\Domain\SourceManagement\SourceMemberInformation;

/**
 * @author kevinfrantz
 */
final class RightChecker implements RightCheckerInterface
{
    /**
     * @var RightInterface
     */
    private $right;

    /**
     * @var Collection|SourceInterface[]
     */
    private $allSourcesToWhichRightApplies;

    /**
     * Calling this function in the constructor can lead to side effects when the source changes!
     * @todo Implement a clean solution!
     */
    private function setAllSourcesToWhichRightApplies(): void
    {
        $rightSourceMemberInformation = new SourceMemberInformation($this->right->getSource());
        $this->allSourcesToWhichRightApplies = clone ($rightSourceMemberInformation->getAllMembers());
        $this->allSourcesToWhichRightApplies->add($this->right->getSource());
    }

    private function hasSource(SourceInterface $source): bool
    {
        return $this->allSourcesToWhichRightApplies->contains($source);   
    }
    
    private function isLayerEqual(string $layer):bool{
        return ($this->right->getLayer() === $layer);
    }
    
    private function isTypeEqual(string $type):bool{
        return ($this->right->getType() === $type);
    }
    
    private function checkPermission():bool{
        return $this->right->getGrant();
    }

    public function __construct(RightInterface $right)
    {
        $this->right = $right;
        $this->setAllSourcesToWhichRightApplies();
    }

    public function isGranted(string $layer, string $type, SourceInterface $source): bool
    {
        return ($this->isLayerEqual($layer) && $this->isTypeEqual($type) && $this->hasSource($source) && $this->checkPermission());
    }
}
