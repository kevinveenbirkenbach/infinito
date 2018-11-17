<?php

namespace App\Entity\Meta;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\RightsAttribute;
use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Attribut\RelationAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="meta_law")
 * @ORM\Entity(repositoryClass="App\Repository\LawRepository")
 */
final class Law extends AbstractMeta implements LawInterface
{
    use RightsAttribute, RelationAttribut;

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
    }
}
