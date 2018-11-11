<?php

namespace App\Entity\Source\Combination;

use App\Entity\Attribut\FirstNameSourceAttribut;
use App\Entity\Attribut\SurnameSourceAttribut;

class FullPersonNameSource extends AbstractCombinationSource implements FullPersonNameSourceInterface
{
    use FirstNameSourceAttribut,SurnameSourceAttribut;
}
