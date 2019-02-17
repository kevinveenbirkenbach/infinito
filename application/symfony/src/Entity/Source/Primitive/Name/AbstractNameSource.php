<?php

namespace Infinito\Entity\Source\Primitive\Name;

use Infinito\Entity\Source\Primitive\AbstractPrimitiveSource;
use Infinito\Attribut\NameAttribut;
use Doctrine\ORM\Mapping as ORM;
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
