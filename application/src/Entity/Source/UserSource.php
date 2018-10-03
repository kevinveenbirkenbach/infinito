<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Attribut\UserAttribut;
use App\Entity\Attribut\NameSourceAttribut;
use App\Entity\UserSourceInterface;
use App\Entity\NameSourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserSourceRepository")
 */
class UserSource extends AbstractSource implements UserSourceInterface
{
    use UserAttribut,NameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="User",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    protected $user;

    /**
     * @Assert\Type(type="App\Entity\NameSource")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="NameSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="name_id", referencedColumnName="id")
     *
     * @var NameSourceInterface
     */
    protected $nameSource;

    public function __construct()
    {
        $this->nameSource = new NameSource();
        parent::__construct();
    }
}
