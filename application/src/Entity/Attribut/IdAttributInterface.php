<?php
namespace App\Entity\Attribut;

/**
 *
 * @author kevinfrantz
 *        
 */
interface IdAttributInterface
{
    public function setId(int $id): void;
    
    public function getId(): int;
}

