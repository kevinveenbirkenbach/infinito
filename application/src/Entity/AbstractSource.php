<?php

namespace App\Entity;

use App\Entity\Attribut\IdAttribut;
use App\Entity\Attribut\NodeAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 *
 * @see https://www.doctrine-project.org/projects/doctrine-orm/en/2.6/reference/inheritance-mapping.html
 * @ORM\Entity
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"user" = "User"})
 */
abstract class AbstractSource implements SourceInterface
{
    use IdAttribut,NodeAttribut;

    public function __construct(){
        $this->node = new Node();
    }
}
