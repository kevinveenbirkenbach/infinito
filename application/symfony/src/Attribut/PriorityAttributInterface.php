<?php

namespace Infinito\Attribut;

interface PriorityAttributInterface
{
    public function setPriority(int $priority): void;

    public function getPriority(): int;
}
