<?php

namespace Infinito\Entity\Source\Complex;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\FirstNameSourceAttribut;
use Infinito\Attribut\SurnameSourceAttribut;
use Infinito\Entity\Source\Primitive\Name\FirstNameSource;
use Infinito\Entity\Source\Primitive\Name\FirstNameSourceInterface;
use Infinito\Entity\Source\Primitive\Name\SurnameSource;
use Infinito\Entity\Source\Primitive\Name\SurnameSourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 */
class FullPersonNameSource extends AbstractComplexSource implements FullPersonNameSourceInterface
{
    use FirstNameSourceAttribut;
    use SurnameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Source\Primitive\Name\SurnameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="surname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SurnameSourceInterface
     */
    protected $surnameSource;

    /**
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Source\Primitive\Name\FirstNameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="firstname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var FirstNameSourceInterface
     */
    protected $firstNameSource;

    public function __construct()
    {
        parent::__construct();
        $this->surnameSource = new SurnameSource();
        $this->firstNameSource = new FirstNameSource();
    }
}
