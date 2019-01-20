<?php

namespace App\Attribut;

/**
 * @author kevinfrantz
 */
trait NameAttribut
{
    /**
     * @var string
     */
    protected $name;

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
