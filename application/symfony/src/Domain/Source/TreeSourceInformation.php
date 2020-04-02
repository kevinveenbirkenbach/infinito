<?php

namespace Infinito\Domain\Source;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\Complex\Collection\TreeCollectionSource;
use Infinito\Entity\Source\Complex\Collection\TreeCollectionSourceInterface;
use Infinito\Entity\Source\SourceInterface;

/**
 * Allows to iterate over a tree.
 *
 * @author kevinfrantz
 *
 * @todo Maybe lazy loading would be helpfull for performance
 */
final class TreeSourceInformation implements TreeSourceInformationInterface
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

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\TreeSourceInformationInterface::getBranches()
     */
    public function getBranches(): Collection
    {
        return $this->branches;
    }

    /**
     * @todo Remove the optional parameter and put the logic in a private funtion.
     * @todo Remove the getAllBranches use inside the function.
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\TreeSourceInformationInterface::getAllBranches()
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

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\TreeSourceInformationInterface::getLeaves()
     */
    public function getLeaves(): Collection
    {
        return $this->leaves;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Source\TreeSourceInformationInterface::getAllLeaves()
     */
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
