<?php

namespace App\Entity\Source\Data\Name;

use App\Entity\Source\Data\AbstractDataSource;
use App\Entity\Attribut\NameAttribut;

abstract class AbstractNameSource extends AbstractDataSource implements NameSourceInterface
{
    use NameAttribut;
}
