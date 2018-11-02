<?php

namespace App\Entity\Source\Collection;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\MembersAttribut;
use App\Entity\Method\CollectionDimensionHelperMethod;

/**
 * @author kevinfrantz
 *
 * @todo remove deprecated trait membersattribut
 * @ORM\Table(name="source_group")
 * @ORM\Entity
 */
final class TreeCollectionSource extends AbstractCollectionSource implements TreeCollectionSourceInterface
{
    use MembersAttribut;
    use CollectionDimensionHelperMethod;
}
