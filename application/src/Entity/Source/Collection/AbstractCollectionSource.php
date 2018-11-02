<?php

namespace App\Entity\Source\Collection;

use App\Entity\Source\AbstractSource;
use App\Entity\Attribut\CollectionAttribut;

/**
 * @todo Implement inhiering classes!
 *
 * @author kevinfrantz
 */
abstract class AbstractCollectionSource extends AbstractSource implements CollectionSourceInterface
{
    use CollectionAttribut;
}
