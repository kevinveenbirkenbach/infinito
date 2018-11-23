<?php

namespace App\Entity\Source\Complex;

use App\Entity\Attribut\FirstNameSourceAttribut;
use App\Entity\Attribut\SurnameSourceAttribut;
use App\Entity\Source\Primitive\Name\SurnameSource;
use App\Entity\Source\Primitive\Name\FirstNameSource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\Primitive\Name\SurnameSourceInterface;
use App\Entity\Source\Primitive\Name\FirstNameSourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Entity()
 */
class FullPersonNameSource extends AbstractComplexSource implements FullPersonNameSourceInterface
{
    use FirstNameSourceAttribut,SurnameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\Primitive\Name\SurnameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="surname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SurnameSourceInterface
     */
    protected $surnameSource;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\Primitive\Name\FirstNameSource",cascade={"persist", "remove"})
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
