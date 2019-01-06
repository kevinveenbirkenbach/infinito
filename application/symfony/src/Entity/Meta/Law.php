<?php

namespace App\Entity\Meta;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RightsAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttribut;
use App\Entity\Source\SourceInterface;
use App\Entity\Attribut\GrantAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_law")
 * @ORM\Entity(repositoryClass="App\Repository\LawRepository")
 */
class Law extends AbstractMeta implements LawInterface
{
    use RightsAttribute, RelationAttribut, GrantAttribut;

    /**
     * @ORM\Column(type="boolean",name="`grant`")
     *
     * @var bool the standart grant value
     */
    protected $grant;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\AbstractSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SourceInterface
     */
    protected $source;

    /**
     * @ORM\OneToMany(targetEntity="Right", mappedBy="law", cascade={"persist", "remove"})
     *
     * @var ArrayCollection | Right[]
     */
    protected $rights;

    public function __construct()
    {
        parent::__construct();
        $this->rights = new ArrayCollection();
        $this->grant = false;
    }
}