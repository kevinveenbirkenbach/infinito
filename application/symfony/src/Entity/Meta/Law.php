<?php

namespace Infinito\Entity\Meta;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\RightsAttribut;
use Doctrine\Common\Collections\ArrayCollection;
use Infinito\Attribut\RelationAttribut;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Attribut\GrantAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_law")
 * @ORM\Entity(repositoryClass="Infinito\Repository\Meta\LawRepository")
 */
class Law extends AbstractMeta implements LawInterface
{
    use RightsAttribut, RelationAttribut, GrantAttribut;

    /**
     * @ORM\Column(type="boolean",name="`grant`")
     *
     * @var bool the standart grant value
     */
    protected $grant;

    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Source\AbstractSource",cascade={"persist", "remove"})
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
