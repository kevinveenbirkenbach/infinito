<?php

namespace App\Entity\Source;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Attribut\UserAttribut;
use App\Entity\Attribut\NameSourceAttribut;
use App\Entity\UserInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserSourceRepository")
 */
final class UserSource extends AbstractSource implements UserSourceInterface
{
    use UserAttribut,NameSourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @Assert\Type(type="App\Entity\Source\NameSource")
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
