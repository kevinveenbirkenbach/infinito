<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;

interface SourceMemberInformationInterface
{
    /**
     * @return Collection|SourceInterface[] All Members which belong to a source
     */
    public function getAllMembers(): Collection;
}
