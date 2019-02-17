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
    const THREAD = 'thread';

    protected static $choices = [
        parent::CREATE => 'create',
        parent::READ => 'read',
        parent::UPDATE => 'update',
        parent::DELETE => 'delete',
        self::THREAD => 'thread',
    ];
}
