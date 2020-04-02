<?php

namespace Infinito\Entity;

use Doctrine\ORM\Mapping as ORM;
use Infinito\Attribut\IdAttribut;
use Infinito\Attribut\VersionAttribut;

/**
 * @author kevinfrantz
 */
abstract class AbstractEntity implements EntityInterface
{
    use IdAttribut;
    use VersionAttribut;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    /**
     * @version @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $version;

    public function __construct()
    {
        $this->version = 0;
    }
}
