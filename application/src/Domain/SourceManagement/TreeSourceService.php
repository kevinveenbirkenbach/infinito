<?php

namespace App\Domain\SourceManagement;

use App\Entity\Source\Collection\TreeCollectionSourceInterface;
use App\Entity\Source\Collection\TreeCollectionSource;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Source\SourceInterface;

/**
 * Allows to iterate over a tree.
 *
 * @author kevinfrantz
 *
 * @todo Maybe lazy loading would be helpfull for performance
 */
final class TreeSourceService extends AbstractSourceService implements TreeSourceServiceInterface
{
    /**
     * @var TreeCollectionSourceInterface
     */
    private $source;

    /**
     * Containes all branches of the actual level of the tree.
     *
     * @var Collection
     */
    private $branches;

    /**
     * Containes all leaves of the actual level of the tree.
     *
     * @var Collection
     */
    private $leaves;

    public function __construct(TreeCollectionSource $source)
    {
        $this->source = $source;
        $this->branches = new ArrayCollection();
        $this->leaves = new ArrayCollection();
        $this->basicSort();
    }

    private function sortMember(SourceInterface $member): bool
    {
        if ($member instanceof TreeCollectionSource) {
            return $this->branches->add($member);
        }

        return $this->leaves->add($member);
    }

    private function basicSort(): void
    {
        foreach ($this->source->getCollection() as $member) {
            $this->sortMember($member);
        }
    }

    public function getBranches(): Collection
    {
        return $this->branches;
    }

    /**
     * @todo Remove the optional parameter and put the logic in a private funtion.
     * @todo Remove the getAllBranches use inside the function.
     * {@inheritdoc}
     *
     * @see \App\Domain\SourceManagement\TreeSourceServiceInterface::getAllBranches()
     */
    public function getAllBranches(): Collection
    {
        $allBranches = new ArrayCollection($this->branches->toArray());
        foreach ($this->branches->toArray() as $branch) {
            $this->itterateOverBranch($branch, $allBranches);
        }

        return $allBranches;
    }

    private function itterateOverBranch(TreeCollectionSourceInterface $branch, ArrayCollection $allBranches): void
    {
        foreach ((new self($branch))->getBranches() as $branchBranch) {
            if (!$allBranches->contains($branchBranch)) {
                $allBranches->add($branchBranch);
                if ($branchBranch instanceof TreeCollectionSourceInterface) {
                    $this->itterateOverBranch($branchBranch, $allBranches);
                }
            }
        }
    }

    public function getLeaves(): Collection
    {
        return $this->leaves;
    }

    public function getAllLeaves(): Collection
    {
        $leaves = new ArrayCollection($this->getLeaves()->toArray());
        foreach ($this->getAllBranches() as $branch) {
            foreach ((new self($branch))->getLeaves() as $leave) {
                if (!$leaves->contains($leave)) {
                    $leaves->add($leave);
                }
            }
        }

        return $leaves;
    }
}
