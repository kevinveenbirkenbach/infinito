<?php

namespace App\Entity\Source\Complex\Collection;

use App\Entity\Source\AbstractSource;
use App\Entity\Attribut\CollectionAttribut;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @author kevinfrantz
 */
abstract class AbstractCollectionSource extends AbstractSource implements CollectionSourceInterface
{
    use CollectionAttribut;

    /**
     * @var Collection|SourceInterface[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Source\AbstractSource")
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
