<?php

namespace App\Entity\Source\Combination;

use App\Entity\Source\AbstractSource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 *
 * @ORM\Entity
 * @ORM\Table(name="source_combination")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "UserSource","fullpersonname" = "FullPersonNameSource","personidentitysource"="PersonIdentitySource","fullpersonnamesource"="FullPersonNameSource"})
 */
abstract class AbstractCombinationSource extends AbstractSource implements CombinationSourceInterface
{
}
