<?php

namespace Infinito\DBAL\Types;

use Fresh\DoctrineEnumBundle\DBAL\Types\AbstractEnumType;

/**
 * Containes all activated languages.
 *
 * @author kevinfrantz
 */
final class LanguageType extends AbstractEnumType
{
    public const GERMAN = 'de';

    public const ENGLISH = 'en';

    public const DUTCH = 'nl';

    public const SPANISH = 'es';

    public const ESPERANTO = 'eo';

    protected static $choices = [
        self::GERMAN => 'German',
        self::ENGLISH => 'English',
        self::SPANISH => 'Spanish',
        self::ESPERANTO => 'Esperanto',
        self::DUTCH => 'Dutch',
    ];
}
