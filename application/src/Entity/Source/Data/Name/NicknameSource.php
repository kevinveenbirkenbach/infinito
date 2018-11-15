<?php

namespace App\Entity\Source\Data\Name;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_data_name_nickname")
 * @ORM\Entity()
 */
final class NicknameSource extends AbstractNameSource implements NicknameSourceInterface
{
}
