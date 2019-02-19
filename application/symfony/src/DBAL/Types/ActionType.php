<?php

namespace Infinito\DBAL\Types;

use Infinito\DBAL\Types\Meta\Right\CRUDType;

/**
 * Containes all actions which can be done.
 *
 * @author kevinfrantz
 */
final class ActionType extends CRUDType
{
    /**
     * @var string this action executes an entity
     */
    const EXECUTE = 'execute';

    /**
     * @var array
     */
    protected static $choices = [
        parent::CREATE => 'create',
        parent::READ => 'read',
        parent::UPDATE => 'update',
        parent::DELETE => 'delete',
        self::EXECUTE => 'execute',
    ];
}
