<?php

namespace Infinito\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\SourceInterface;

/**
 * Offers to get all source members over all dimensions.
 *
 * @author kevinfrantz
 */
interface SourceMemberInformationInterface
{
    /**
     * @return Collection|SourceInterface[] All Members which belong to a source
     */
    public function getAllMembers(): Collection;
}
