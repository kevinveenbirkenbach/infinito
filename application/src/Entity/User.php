<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Entity\Attribut\UsernameAttribut;
use App\Entity\Attribut\PasswordAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="source_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends AbstractSource implements UserInterface
{
    use UsernameAttribut,PasswordAttribut;
 
    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
    }

    public function getSalt()
    {
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized, array('allowed_classes' => false));
    }
}
