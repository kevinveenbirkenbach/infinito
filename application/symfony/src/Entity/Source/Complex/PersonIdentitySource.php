<?php

namespace Infinito\Entity\Source\Complex;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\FullPersonNameSourceAttribut;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 */
class PersonIdentitySource extends AbstractComplexSource implements PersonIdentitySourceInterface
{
    use FullPersonNameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="FullPersonNameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="fullname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var FullPersonNameSourceInterface
     */
    protected $fullPersonNameSource;

    public function __construct()
    {
        parent::__construct();
        $this->fullPersonNameSource = new FullPersonNameSource();
    }
}
