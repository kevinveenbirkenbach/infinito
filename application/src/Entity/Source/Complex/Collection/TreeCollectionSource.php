<?php

namespace App\Entity\Source\Complex\Collection;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\CollectionAttribut;

/**
 * @author kevinfrantz
 * @ORM\Entity
 */
class TreeCollectionSource extends AbstractCollectionSource implements TreeCollectionSourceInterface
{
    use CollectionAttribut;
}
