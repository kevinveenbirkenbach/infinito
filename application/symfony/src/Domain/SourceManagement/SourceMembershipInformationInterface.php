<?php

namespace Infinito\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\SourceInterface;

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
