<?php

namespace App\Entity\Source\Data;

class PesonIdentitySource extends AbstractDataSource implements PersonIdentitySourceInterface
{
    /**
     * @Assert\Type(type="App\Entity\Source\NameSource")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="NameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="name_id", referencedColumnName="id")
     *
     * @var NameSourceInterface
     */
    protected $nameSource;
}
