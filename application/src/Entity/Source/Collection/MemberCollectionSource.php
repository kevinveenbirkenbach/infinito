<?php

namespace App\Entity\Source\Collection;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\MembersAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_group")
 * @ORM\Entity
 */
final class MemberCollectionSource extends AbstractCollectionSource implements MemberCollectionSourceInterface
{
    use MembersAttribut;
}
