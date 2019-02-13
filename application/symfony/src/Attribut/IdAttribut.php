<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 *
 * @see IdAttributInterface
 */
trait IdAttribut
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function hasId(): bool
    {
        return isset($this->id);
    }
}
