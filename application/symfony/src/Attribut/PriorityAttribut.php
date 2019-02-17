<?php

namespace Infinito\Attribut;

trait PriorityAttribut
{
    /**
     * @var int
     */
    protected $priority;

    public function setPriority(int $priority): void
    {
        $this->priority = $priority;
    }

    public function getPriority(): int
    {
        return $this->priority;
    }
}
