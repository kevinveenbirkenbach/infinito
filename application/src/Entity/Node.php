<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Attribut\ParentsAttribut;
use App\Entity\Attribut\ChildsAttribut;
use App\Entity\Attribut\LawAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="node")
 * @ORM\Entity(repositoryClass="App\Repository\NodeRepository")
 */
class Node extends AbstractEntity implements NodeInterface
{
    use IdAttribut,
    SourceAttribut,
    ParentsAttribut,
    LawAttribut,
    ChildsAttribut;

    /**
     * @ORM\OneToOne(targetEntity="AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     *
     * @var SourceInterface
     */
    protected $source;

    /**
     * @ORM\OneToOne(targetEntity="Law",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="law_id", referencedColumnName="id")
     *
     * @var LawInterface
     */
    protected $law;

    public function __construct()
    {
        $this->law = new Law();
        $this->law->setNode($this);
    }
}
