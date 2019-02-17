<?php

namespace Infinito\Entity\Source;

use Doctrine\ORM\Mapping as ORM;

/**
 * This class represents a source with no additional attributes
 * Never inhiere from this!
 * Use instead AbstractSource!
 *
 * @author kevinfrantz
 * @ORM\Entity
 */
class PureSource extends AbstractSource implements PureSourceInterface
{
    public function __construct()
    {
        parent::__construct();
    }
}
