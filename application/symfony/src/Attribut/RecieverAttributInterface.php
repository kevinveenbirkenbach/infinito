<?php

namespace Infinito\Attribut;

use Infinito\Entity\Source\SourceInterface;

/**
 * @author kevinfrantz
 */
interface RecieverAttributInterface
{
    /**
     * @param SourceInterface|null $reciever If null, then all recievers MUST be addressed. Otherwise just a special reciever
     */
    public function setReciever(?SourceInterface $reciever): void;

    public function getReciever(): SourceInterface;

    /**
     * @return bool True if it has a special reciever
     */
    public function hasReciever(): bool;
}
