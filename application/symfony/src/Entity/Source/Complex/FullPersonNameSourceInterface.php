<?php

namespace Infinito\Entity\Source\Complex;

use Infinito\Attribut\FirstNameSourceAttributInterface;
use Infinito\Attribut\SurnameSourceAttributInterface;

/**
 * @todo Maybe a middle name would be helpfull in the future ;)
 *
 * @author kevinfrantz
 */
interface FullPersonNameSourceInterface extends ComplexSourceInterface, FirstNameSourceAttributInterface, SurnameSourceAttributInterface
{
}
