<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * Allows to group other sources in a source
 *
 * @author kevinfrantz
 *        
 */
interface MembersAttributInterface
{

    /**
     * @param Collection $members
     */
    public function setMembers(Collection $members): void;

    /**
     * @return Collection
     */
    public function getMembers(): Collection;
}