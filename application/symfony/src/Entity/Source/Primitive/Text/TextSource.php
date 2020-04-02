<?php

namespace Infinito\Entity\Source\Primitive\Text;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\TextAttribut;
use Infinito\Entity\Source\Primitive\AbstractPrimitiveSource;

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
