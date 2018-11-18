<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FirstNameSourceAttribut;
use App\Entity\Attribut\SurnameSourceAttribut;
use App\Entity\Source\Data\Name\SurnameSource;
use App\Entity\Source\Data\Name\FirstNameSource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_combination_fullpersonname")
 * @ORM\Entity()
 */
class FullPersonNameSource extends AbstractCombinationSource implements FullPersonNameSourceInterface
{
    use FirstNameSourceAttribut,SurnameSourceAttribut;

    public function __construct()
    {
        parent::__construct();
        $this->surnameSource = new SurnameSource();
        $this->firstNameSource = new FirstNameSource();
    }
}
