<?php

namespace App\Entity\Source\Data\Name;

use App\Entity\Source\Data\AbstractDataSource;
use App\Entity\Attribut\NameAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 *
 * @ORM\Entity
 * @ORM\Table(name="source_data_name")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"nickname" = "NicknameSource","firstname" = "FirstNameSource", "lastname" = "LastNameSource"})
 */
abstract class AbstractNameSource extends AbstractDataSource implements NameSourceInterface
{
    use NameAttribut;
}
