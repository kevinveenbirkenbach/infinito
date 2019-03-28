<?php

namespace Infinito\Domain\ParameterManagement;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Request;
use Infinito\Exception\UnvalidParameterException;
use Infinito\Exception\NotDefinedException;

/**
 * @todo Rename class!
 *
 * @author kevinfrantz
 */
class OptionalGetParameterService implements OptionalGetParameterServiceInterface
{
    /**
     * @var Request
     */
    protected $currentRequest;

    /**
     * @param string $key
     *
     * @throws UnvalidParameterException If the parameter is not valid
     */
    protected function validateParameter(string $key): void
    {
        if (in_array($key, self::OPTIONAL_PARAMETERS)) {
            return;
        }
        throw new UnvalidParameterException("Parameter <<$key>> isn't valid.");
    }

    /**
     * @param RequestStack $requestStack
     */
    private function setCurrentRequest(RequestStack $requestStack): void
    {
        $this->currentRequest = $requestStack->getCurrentRequest();
    }

    private function validateCurrentRequestKeys(): void
    {
        foreach ($this->currentRequest->query->keys() as $key) {
            $this->validateParameter($key);
        }
    }

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack)
    {
        $this->setCurrentRequest($requestStack);
        $this->validateCurrentRequestKeys();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\OptionalGetParameterServiceInterface::hasParameter()
     */
    public function hasParameter(string $key): bool
    {
        $this->validateParameter($key);

        return $this->currentRequest->query->has($key);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\OptionalGetParameterServiceInterface::getParameter()
     */
    public function getParameter(string $key)
    {
        $this->validateParameter($key);
        if ($this->hasParameter($key)) {
            return $this->currentRequest->get($key);
        }
        throw new NotDefinedException("The parameter <<$key>> is not defined!");
    }
}
