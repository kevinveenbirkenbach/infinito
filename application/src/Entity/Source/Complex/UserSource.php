<?php

namespace App\Entity\Source\Complex;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\UserAttribut;
use App\Entity\UserInterface;
use App\Entity\Attribut\PersonIdentitySourceAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_data_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserSourceRepository")
 */
class UserSource extends AbstractComplexSource implements UserSourceInterface
{
    use UserAttribut,PersonIdentitySourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var UserInterface
     */
    protected $user;

    /**
     * @ORM\OneToOne(targetEntity="PersonIdentitySource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="identity_id", referencedColumnName="id",onDelete="CASCADE")
     *
     * @var PersonIdentitySourceInterface
     */
    protected $personIdentitySource;

    public function __construct()
    {
        parent::__construct();
    }

    public function hasPersonIdentitySource(): bool
    {
        return isset($this->personIdentitySource);
    }
}
