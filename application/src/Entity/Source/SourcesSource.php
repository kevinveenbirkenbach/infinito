<?php
namespace App\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Source\Attribut\SourcesAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="source_sources")
 * @ORM\Entity
 */
class SourcesSource extends AbstractSource implements SourcesSourceInterface
{
    use SourcesAttribut;

    /**
     *
     * @var Collection
     * @ORM\ManyToMany(targetEntity="AbstractSource")
     */
    protected $sources;
}

