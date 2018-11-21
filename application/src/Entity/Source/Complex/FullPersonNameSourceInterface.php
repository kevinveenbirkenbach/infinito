<?php

namespace App\Entity\Source\Complex;

use App\Entity\Attribut\FirstNameSourceAttributInterface;
use App\Entity\Attribut\SurnameSourceAttributInterface;

/**
 * @todo Maybe a middle name would be helpfull in the future ;)
 *
 * @author kevinfrantz
 */
interface FullPersonNameSourceInterface extends ComplexSourceInterface, FirstNameSourceAttributInterface, SurnameSourceAttributInterface
{
}
