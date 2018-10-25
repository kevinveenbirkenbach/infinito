<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * Allows to group other sources in a source
 *
 * @author kevinfrantz
 *        
 */
interface SourceMembersAttributInterface
{

    /**
     * Sets the collection source members
     *
     * @param Collection $members
     */
    public function setMembers(Collection $members): void;

    /**
     * Returns the collection source members
     *
     * @return Collection
     */
    public function getMembers(): Collection;
}

