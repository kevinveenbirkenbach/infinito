<?php

namespace Infinito\Entity\Source\Primitive\Text;

use Infinito\Entity\Source\Primitive\AbstractPrimitiveSource;
use Infinito\Attribut\TextAttribut;
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
