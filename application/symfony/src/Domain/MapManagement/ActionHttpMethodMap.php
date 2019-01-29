<?php

namespace App\Domain\MapManagement;

use App\DBAL\Types\ActionType;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author kevinfrantz
 */
final class ActionHttpMethodMap extends AbstractMap implements ActionHttpMethodMapInterface
{
    const ACTION_HTTP_METHOD_MAP = [
        ActionType::READ => [
            Request::METHOD_GET,
        ],
        ActionType::CREATE => [
            Request::METHOD_POST,
            Request::METHOD_GET,
        ],
        ActionType::UPDATE => [
            Request::METHOD_PUT,
            Request::METHOD_GET,
        ],
        ActionType::DELETE => [
            Request::METHOD_GET,
            Request::METHOD_DELETE,
        ],
        ActionType::THREAD => [
            Request::METHOD_GET,
        ],
    ];

    public static function getActions(string $httpMethod): array
    {
        return parent::getIndizesByValue($httpMethod, self::ACTION_HTTP_METHOD_MAP);
    }

    public static function getHttpMethods(string $action): array
    {
        return parent::getValuesByIndex($action, self::ACTION_HTTP_METHOD_MAP);
    }
}
