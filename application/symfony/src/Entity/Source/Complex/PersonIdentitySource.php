<?php

namespace App\Entity\Source\Complex;

use App\Attribut\FullPersonNameSourceAttribut;
use Doctrine\ORM\Mapping as ORM;

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
