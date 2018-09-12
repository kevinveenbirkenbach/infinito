<?php
namespace App\Entity\Attribut;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 * @author kevinfrantz
 *        
 */
trait PlainPasswordAttribute {

    /**
     * 
     * @Assert\NotBlank()
     * @Assert\Length(max=4096)
     * @var string
     */
    private $plainPassword;

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $password): void
    {
        $this->plainPassword = $password;
    }
}

