<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;

interface TreeSourceServiceInterface
{
    /**
     * Delivers the branches of the actual tree back.
     *
     * @return Collection
     */
    public function getBranches(): Collection;

    /**
     * Delivers the members of the actual tree back.
     *
     * @return Collection
     */
    public function getLeaves(): Collection;

    /**
     * Delivers all members till a infinite level of the tree back.
     *
     * @return Collection
     */
    public function getAllLeaves(): Collection;

    /**
     * Delivers all branches till a infinite level of the actual tree back.
     *
     * @return Collection
     */
    public function getAllBranches(): Collection;
}
