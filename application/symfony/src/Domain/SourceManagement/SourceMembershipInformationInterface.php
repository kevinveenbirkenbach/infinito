<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

/**
 * Offers to get all memberships of a source.
 *
 * @author kevinfrantz
 */
interface SourceMembershipInformationInterface
{
    /**
     * @return Collection|SourceInterface[] all Sources which a Source belongs to
     */
    public function getAllMemberships(): Collection;
}
