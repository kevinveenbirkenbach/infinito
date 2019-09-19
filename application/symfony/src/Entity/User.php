<?php

namespace Infinito\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Infinito\Attribut\SourceAttribut;
use Infinito\Attribut\IdAttribut;
use Infinito\Entity\Source\Complex\UserSourceInterface;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Attribut\VersionAttribut;

/**
 * @author kevinfrantz
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Infinito\Repository\UserRepository")
 */
class User extends BaseUser implements UserInterface
{
    use SourceAttribut;
    use IdAttribut;
    use VersionAttribut;

    /**
     * @var UserSourceInterface
     * @ORM\OneToOne(targetEntity="Infinito\Entity\Source\Complex\UserSource",cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="source_user_id", referencedColumnName="id", onDelete="CASCADE")
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

    /**
     * @version @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $version;

    /**
     * @todo Initialize all needed attributs
     */
    public function __construct()
    {
        parent::__construct();
        $this->version = 0;
        $this->isActive = true;
        $this->source = new UserSource();
        $this->source->setUser($this);
    }
}
