<?php

namespace App\Entity;

use App\Entity\Attribut\IdAttribut;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\VersionAttribut;

/**
 * @author kevinfrantz
 */
abstract class AbstractEntity implements EntityInterface
{
    use IdAttribut, VersionAttribut;

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
    }
}
