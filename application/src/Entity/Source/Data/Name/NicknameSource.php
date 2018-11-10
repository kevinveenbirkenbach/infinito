<?php

namespace App\Entity\Source\Data\Name;

use App\Entity\Attribut\NameAttribut;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_data_name")
 * @ORM\Entity(repositoryClass="App\Repository\NameSourceRepository")
 */
final class NicknameSource extends AbstractNameSource implements NicknameSourceInterface
{
    use NameAttribut;

    /**
     * @todo Implement an extra assert Layer!
     * @ORM\Column(type="string",length=255)
     * @Assert\NotBlank()
     * @var string
     */
    protected $name;

    public function __construct()
    {
        parent::__construct();
    }
}
