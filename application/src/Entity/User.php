<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use App\Entity\Attribut\NodeAttribut;

/**
 *
 * @author kevinfrantz
 * @ORM\Table(name="source_user")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser implements SourceInterface
{
    use NodeAttribut;
 
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
    
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    
    public function getId(): int
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct ();
        /**
         * @todo Remove this later
         * @var \App\Entity\User $isActive
         */
        $this->isActive = true;
    }
}
