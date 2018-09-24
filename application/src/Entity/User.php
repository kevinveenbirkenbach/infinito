<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use App\Entity\Attribut\Interfaces\SourceAttributInterface;
use App\Entity\Attribut\SourceAttribut;
use App\Entity\Attribut\IdAttribut;
use App\Creator\Modificator\Entity\LawModificator;
use App\Entity\Interfaces\UserInterface;
use App\Entity\Interfaces\UserSourceInterface;

/**
 * @author kevinfrantz
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser implements UserInterface
{
    use SourceAttribut,IdAttribut;

    /**
     * @var UserSourceInterface
     * @ORM\OneToOne(targetEntity="UserSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_user_id", referencedColumnName="id")
     */
    protected $source;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        $this->isActive = true;
        $this->source = new UserSource();
        LawModificator::grantAllRights($this->source->getNode()->getLaw(), $this->source->getNode());
        //var_dump($this->source->getNode()->getLaw()->getRights()->get(0));
    }
}
