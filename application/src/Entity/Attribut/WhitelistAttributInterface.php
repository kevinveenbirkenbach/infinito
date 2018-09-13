<?php
namespace Entity\Attribut;

/**
 *
 * @author kevinfrantz
 *        
 */
interface WhitelistAttributInterface
{
    public function setWhitelist(?bool $value): void;
    
    public function getWhitelist(): ?bool;
}

