<?php

namespace Infinito\Entity\Source\Complex\Collection;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\CollectionAttribut;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
abstract class AbstractCollectionSource extends AbstractSource implements CollectionSourceInterface
{
    use CollectionAttribut;

    /**
     * @var Collection|SourceInterface[]
     * @ORM\ManyToMany(targetEntity="Infinito\Entity\Source\AbstractSource")
     * @ORM\JoinTable(name="collection_source",
     *      joinColumns={@ORM\JoinColumn(name="collection_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="source_id", referencedColumnName="id")}
     *  )
     */
    protected $collection;

    public function __construct()
    {
        parent::__construct();
        $this->collection = new ArrayCollection();
    }
}
