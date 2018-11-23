<?php

namespace App\Entity\Source\Primitive;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Source\AbstractSource;

/**
 * @author kevinfrantz
 *
 * @ORM\Entity
 * @ORM\Table(name="source_data")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"name" = "App\Entity\Source\Primitive\Name\AbstractNameSource","text" = "App\Entity\Source\Primitive\Text\TextSource"})
 */
abstract class AbstractPrimitiveSource extends AbstractSource implements PrimitiveSourceInterface
{
}
