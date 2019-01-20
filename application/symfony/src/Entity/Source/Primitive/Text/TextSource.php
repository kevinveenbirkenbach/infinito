<?php

namespace App\Entity\Source\Primitive\Text;

use App\Entity\Source\Primitive\AbstractPrimitiveSource;
use App\Attribut\TextAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Entity
 */
class TextSource extends AbstractPrimitiveSource implements TextSourceInterface
{
    use TextAttribut;

    /**
     * @ORM\Column(type="string")
     *
     * @var string
     */
    protected $text;
}
