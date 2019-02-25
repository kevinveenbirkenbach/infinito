<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\History\LogInterface;

/**
 * @author kevinfrantz
 *
 * @see LogsAttributInterface
 */
trait LogsAttribut
{
    /**
     * @var Collection|LogInterface[]
     */
    protected $logs;

    /**
     * @param Collection|LogInterface[] $logs
     */
    public function setLogs(Collection $logs): void
    {
        $this->logs = $logs;
    }

    /**
     * @return Collection|LogInterface[]
     */
    public function getLogs(): Collection
    {
        return $this->logs;
    }
}
