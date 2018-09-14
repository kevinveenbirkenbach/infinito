<?php

namespace App\Entity;

use App\Entity\Attribut\NameAttribut;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_name")
 * @ORM\Entity(repositoryClass="App\Repository\NameSourceRepository")
 */
class NameSource extends AbstractSource implements NameSourceInterface
{
    use NameAttribut;

    /**
     * @ORM\Column(type="string",length=255)
     *
     * @var string
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
        $this->name = '';
    }
}
