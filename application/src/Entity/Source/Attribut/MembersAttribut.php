<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 *
 * @author kevinfrantz
 *        
 */
trait MembersAttribut
{

    /**
     *
     * @var Collection
     */
    protected $members;

    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function setMembers(Collection $members): void
    {
        $this->members = $members;
    }
}

