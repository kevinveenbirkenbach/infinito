<?php

namespace App\Entity\Attribut;

/**
 * @author kevinfrantz
 */
interface IdAttributInterface
{
    /**
     * @param int $id
     */
    public function setId(int $id): void;

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return bool Checks if attribute is set
     */
    public function hasId(): bool;
}
