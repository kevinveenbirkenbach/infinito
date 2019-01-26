<?php

namespace App\Domain\TemplateManagement;

use App\DBAL\Types\RESTResponseType;

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
