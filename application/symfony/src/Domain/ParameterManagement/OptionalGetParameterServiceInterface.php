<?php

namespace Infinito\Domain\ParameterManagement;

/**
 * This interface offers a service to manage all optional get parameters.
 *
 * @author kevinfrantz
 */
interface OptionalGetParameterServiceInterface
{
    /**
     * @var string
     */
    const VERSION_PARAMETER = 'version';

    /**
     * @var string
     */
    const EXECUTE_PARAMETER = 'execute';

    /**
     * @var string
     */
    const VIEW_PARAMETER = 'view';

    /**
     * @var string
     */
    const CLASS_PARAMETER = 'class';

    /**
     * @var string
     */
    const FRAME_PARAMETER = 'frame';

    /**
     * @var string
     */
    const SCHEMA_PARAMETER = 'schema';

    /**
     * @var array|string[]
     */
    const OPTIONAL_PARAMETERS = [
        self::VERSION_PARAMETER,
        self::VIEW_PARAMETER,
        self::CLASS_PARAMETER,
        self::FRAME_PARAMETER,
        self::SCHEMA_PARAMETER,
        self::EXECUTE_PARAMETER,
    ];

    /**
     * @param string $key
     *
     * @return bool True if the version parameter in the request is set
     */
    public function hasParameter(string $key): bool;

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getParameter(string $key);
}
