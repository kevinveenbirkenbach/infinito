<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

interface SourceMembershipInformationInterface
{
    /**
     * @return Collection|SourceInterface[] all Sources which a Source belongs to
     */
    public function getAllMemberships(): Collection;
}
