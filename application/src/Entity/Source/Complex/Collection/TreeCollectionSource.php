<?php

namespace App\Entity\Source\Complex\Collection;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\CollectionAttribut;

/**
 * @author kevinfrantz
 *
 * @todo remove deprecated trait membersattribut
 * @ORM\Table(name="source_group")
 * @ORM\Entity
 */
class TreeCollectionSource extends AbstractCollectionSource implements TreeCollectionSourceInterface
{
    use CollectionAttribut;
}
