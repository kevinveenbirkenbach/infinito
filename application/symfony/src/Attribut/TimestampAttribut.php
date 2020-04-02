<?php

namespace Infinito\Attribut;

use Infinito\Exception\AllreadySetException;

/**
 * @author kevinfrantz
 *
 * @see TimestampAttributInterface
 */
trait TimestampAttribut
{
    /**
     * @var \DateTime
     */
    protected $timestamp;

    /**
     * @param \DateTime $datetime
     */
    public function setTimestamp(\DateTime $timestamp): void
    {
        if (isset($this->timestamp)) {
            throw new AllreadySetException('The timestamp is allready set. An Update is not possible!');
        }
        $this->timestamp = $timestamp;
    }

    public function getTimestamp(): \DateTime
    {
        return $this->timestamp;
    }
}
