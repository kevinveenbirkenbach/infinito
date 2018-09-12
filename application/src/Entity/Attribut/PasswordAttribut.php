<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
trait PasswordAttribut
{
    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }
}
