<?php

namespace Infinito\Domain\TwigManagement;

use Infinito\DBAL\Types\ActionType;
use Infinito\Exception\Collection\NotSetElementException;

/**
 * @author kevinfrantz
 */
final class ActionIconClassMap implements ActionIconClassMapInterface
{
    /**
     * @var array|string[]
     */
    const ACTION_ICON_CLASS_MAP = [
        ActionType::READ => 'fas fa-glasses',
        ActionType::EXECUTE => 'fas fa-microchip',
        ActionType::UPDATE => 'fas fa-pencil-alt',
        ActionType::DELETE => 'fas fa-trash-alt',
        ActionType::CREATE => 'fas fa-plus-square',
    ];

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\TwigManagement\ActionIconClassMapInterface::getIconClass()
     */
    public function getIconClass(string $action): string
    {
        if (key_exists($action, self::ACTION_ICON_CLASS_MAP)) {
            return self::ACTION_ICON_CLASS_MAP[$action];
        }
        throw new NotSetElementException("The key <<$action>> is not defined in the map!");
    }
}
