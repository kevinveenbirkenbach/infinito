<?php

namespace App\Entity\Source\Data\Name;

use App\Entity\Source\Data\AbstractDataSource;
use App\Entity\Attribut\NameAttribut;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author kevinfrantz
 *
 * @ORM\Entity
 * @ORM\Table(name="source_data_name")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"nickname" = "NicknameSource","firstname" = "FirstNameSource", "surname" = "SurnameSource"})
 */
abstract class AbstractNameSource extends AbstractDataSource implements NameSourceInterface
{
    use NameAttribut;

    /**
     * @todo Implement an extra assert Layer! - maybe ;)
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
