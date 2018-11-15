<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FirstNameSourceAttribut;
use App\Entity\Attribut\SurnameSourceAttribut;
use App\Entity\Source\Data\Name\SurnameSource;
use App\Entity\Source\Data\Name\FirstNameSource;

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
