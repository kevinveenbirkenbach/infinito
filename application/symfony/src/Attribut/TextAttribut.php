<?php

namespace Infinito\Attribut;

/**
 * @author kevinfrantz
 *
 * @see TextAttributInterface
 */
trait TextAttribut
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText(string $text): void
    {
        $this->text = $text;
    }
}
