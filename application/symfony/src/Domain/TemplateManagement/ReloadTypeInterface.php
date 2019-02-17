<?php

namespace Infinito\Domain\TemplateManagement;

use Infinito\DBAL\Types\RESTResponseType;

/**
 * @author kevinfrantz
 *
 * @deprecated
 */
interface ReloadTypeInterface
{
    /**
     * Reloads a Template type.
     *
     * @see RESTResponseType::$choices
     *
     * @param string $type
     */
    public function reloadType(string $type): void;
}
