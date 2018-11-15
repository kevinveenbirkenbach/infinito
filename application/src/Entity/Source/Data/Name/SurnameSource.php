<?php

namespace App\Entity\Source\Data\Name;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_data_name_surname")
 * @ORM\Entity()
 */
final class SurnameSource extends AbstractNameSource implements SurnameSourceInterface
{
}
