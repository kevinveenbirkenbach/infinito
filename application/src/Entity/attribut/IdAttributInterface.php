<?php
namespace App\Entity\attribut;

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

