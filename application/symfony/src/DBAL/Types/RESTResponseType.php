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
    /**
     * @var string
     */
    public const JSON = 'json';

    /**
     * @var string
     */
    public const HTML = 'html';

    /**
     * @var string
     */
    public const XML = 'xml';

    /**
     * @var array
     */
    protected static $choices = [
        self::JSON => 'json',
        self::HTML => 'html',
        self::XML => 'xml',
    ];
}
