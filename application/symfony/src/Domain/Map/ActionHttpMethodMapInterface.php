<?php

namespace Infinito\Domain\Map;

/**
 * This class offers a map for ActionTypes to HttpMethods.
 *
 * @author kevinfrantz
 */
interface ActionHttpMethodMapInterface
{
    /**
     * @return array|string[] The Http-Methods which belong to an action
     */
    public static function getActions(string $httpMethod): array;

    /**
     * @return array|string[] The Http-Methods which are possible for an action
     */
    public static function getHttpMethods(string $action): array;
}
