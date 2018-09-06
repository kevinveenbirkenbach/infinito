<?php
namespace App\Entity\Attribut;

/**
 * This trait doesn't need an own interface because it's covered by symfony
 * @author kevinfrantz
 *        
 */
trait UsernameAttribut{
    
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     */
    protected $username;
    
    public function getUsername():string
    {
        return $this->username;
    }
    
    public function setUsernames(string $username):void{
        $this->username = $username;
    }
}

