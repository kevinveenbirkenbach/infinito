<?php
namespace App\Entity\Source\Attribut;

use Doctrine\Common\Collections\Collection;

/**
 *
 * @author kevinfrantz
 *        
 */
trait SourcesAttribut
{

    /**
     *
     * @var Collection
     */
    protected $sources;

    public function getSources(): Collection
    {
        return $this->sources;
    }

    public function setSources(Collection $sources): void
    {
        $this->sources = $sources;
    }
}

