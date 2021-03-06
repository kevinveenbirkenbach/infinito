<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 */
interface TimestampAttributInterface
{
    /**
     * @var string
     */
    const TIMESTAMP_ATTRIBUT_NAME = 'timestamp';

    /**
     * @param \DateTime $datetime
     */
    public function setTimestamp(\DateTime $timestamp): void;

    public function getTimestamp(): \DateTime;
}
