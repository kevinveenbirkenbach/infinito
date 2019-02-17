<?php

namespace Infinito\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Containes the template types which the system can process.
 *
 * @author kevinfrantz
 */
final class RESTResponseType extends AbstractEnumType
{
    public const JSON = 'json';

    public const HTML = 'html';

    public const XML = 'xml';

    protected static $choices = [
        self::JSON => 'json',
        self::HTML => 'html',
        self::XML => 'xml',
    ];
}
