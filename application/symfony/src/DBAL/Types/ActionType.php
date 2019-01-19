<?php

namespace App\DBAL\Types;

use App\DBAL\Types\Meta\Right\CRUDType;

/**
 * Containes all actions which can be done.
 *
 * @author kevinfrantz
 */
final class ActionType extends CRUDType
{
    const LIST = 'list';

    protected static $choices = [
        parent::CREATE => 'create',
        parent::READ => 'read',
        parent::UPDATE => 'update',
        parent::DELETE => 'delete',
        self::LIST => 'list',
    ];
}
