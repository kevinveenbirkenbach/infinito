<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 * Allows to group other sources in a source
 *
 * @author kevinfrantz
 *        
 */
interface SourcesAttributInterface
{

    /**
     * @param Collection $members
     */
    public function setSources(Collection $sources): void;

    /**
     * @return Collection
     */
    public function getSources(): Collection;
}

