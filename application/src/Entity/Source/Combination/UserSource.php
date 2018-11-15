<?php

namespace App\Entity\Source\Combination;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\UserAttribut;
use App\Entity\UserInterface;
use App\Entity\Attribut\PersonIdentitySourceAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="source_data_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserSourceRepository")
 */
class UserSource extends AbstractCombinationSource implements UserSourceInterface
{
    use UserAttribut,PersonIdentitySourceAttribut;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $user;

    public function __construct()
    {
        parent::__construct();
    }
}
