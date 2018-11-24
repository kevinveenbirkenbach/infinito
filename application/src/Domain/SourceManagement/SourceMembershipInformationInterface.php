<?php

namespace App\Domain\SourceManagement;

use Doctrine\Common\Collections\Collection;

interface SourceMembershipInformationInterface
{
    public function getAllMemberships(): Collection;
}
