<?php

namespace App\Entity;

use App\Entity\Attribut\IdAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 */
class AbstractEntity
{
    use IdAttribut;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")(strategy="AUTO")
     *
     * @var int
     */
    protected $id;

    public function __construct()
    {
        //$this->id = 0;
    }
}
