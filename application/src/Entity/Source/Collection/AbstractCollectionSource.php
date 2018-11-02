<?php

namespace App\Entity\Source\Collection;

use App\Entity\Source\AbstractSource;
use App\Entity\Attribut\CollectionAttribut;
use Doctrine\Common\Collections\Collection;
use App\Entity\Source\SourceInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="source_collection")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"member" = "TreeCollectionSource"})
 *
 * @author kevinfrantz
 */
abstract class AbstractCollectionSource extends AbstractSource implements CollectionSourceInterface
{
    use CollectionAttribut;

    /**
     * @var Collection|SourceInterface[]
     * @ORM\ManyToMany(targetEntity="App\Entity\Source\AbstractSource",inversedBy="memberships")
     * @ORM\JoinTable(name="source_group_members")
     */
    protected $collection;

    public function __construct()
    {
        parent::__construct();
        $this->collection = new ArrayCollection();
    }
}
