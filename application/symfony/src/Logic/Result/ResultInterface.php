<?php

namespace Infinito\Logic\Result;

/**
 * @author kevinfrantz
 *
 * @deprecated
 *
 * @todo Rethink and move it to the correct place ;)
 */
interface ResultInterface
{
    /**
     * Returns the Result as a string.
     *
     * @return string
     */
    //public function __toString():string;

    /**
     * Returns if the result is true.
     *
     * @return bool
     */
    public function getBool(): bool;

    public function setBool(bool $bool): void;

    /**
     * Returns the concrete result value.
     *
     * @var mixed
     */
    public function getValue();

    public function setValue($value): void;

    /**
     * Sets bool and value attribut.
     *
     * @param mixed $value
     */
    public function setAll($value): void;
}
