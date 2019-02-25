<?php

namespace Infinito\Attribut;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Meta\History\LogInterface;

/**
 * @author kevinfrantz
 */
interface LogsAttributInterface
{
    /**
     * @var string
     */
    const LOGS_ATTRIBUT_NAME = 'logs';

    /**
     * @param Collection|LogInterface[] $logs
     */
    public function setLogs(Collection $logs): void;

    /**
     * @return Collection|LogInterface[]
     */
    public function getLogs(): Collection;
}
