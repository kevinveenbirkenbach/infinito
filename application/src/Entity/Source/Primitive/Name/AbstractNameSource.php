<?php

namespace App\Entity\Source\Primitive\Name;

use App\Entity\Source\Primitive\AbstractPrimitiveSource;
use App\Entity\Attribut\NameAttribut;
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
