<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FirstNameSourceAttribut;
use App\Entity\Attribut\SurnameSourceAttribut;
use App\Entity\Source\Data\Name\SurnameSource;
use App\Entity\Source\Data\Name\FirstNameSource;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\Data\Name\SurnameSourceInterface;
use App\Entity\Source\Data\Name\FirstNameSourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_combination_fullpersonname")
 * @ORM\Entity()
 */
class FullPersonNameSource extends AbstractCombinationSource implements FullPersonNameSourceInterface
{
    use FirstNameSourceAttribut,SurnameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\Data\Name\SurnameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="surname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var SurnameSourceInterface
     */
    protected $surnameSource;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Source\Data\Name\FirstNameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="firstname_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var FirstNameSourceInterface
     */
    protected $firstnNameSource;

    public function __construct()
    {
        parent::__construct();
        $this->surnameSource = new SurnameSource();
        $this->firstNameSource = new FirstNameSource();
    }
}
