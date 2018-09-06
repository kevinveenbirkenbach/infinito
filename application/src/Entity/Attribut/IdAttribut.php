<?php
namespace App\Entity\Attribut;

/**
 *
 * @author kevinfrantz
 *        
 */
trait IdAttribut {
    /**
     * @ORM\Id
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
}

