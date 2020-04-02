<?php

namespace Infinito\Entity\Source\Primitive\Name;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\NameAttribut;
use Infinito\Entity\Source\Primitive\AbstractPrimitiveSource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 */
class AbstractNameSource extends AbstractPrimitiveSource implements NameSourceInterface
{
    use NameAttribut;

    /**
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     *
     * @var string
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
    }
}
