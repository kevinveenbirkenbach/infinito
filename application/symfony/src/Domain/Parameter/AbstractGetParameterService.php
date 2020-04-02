<?php

namespace Infinito\Domain\Parameter;

use Infinito\Exception\Collection\NotSetElementException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * This class exists out of refactoring reasons.
 * Feel free to merge it with ValidGetParametersServices.
 *
 * @author kevinfrantz
 */
abstract class AbstractGetParameterService implements GetParameterServiceInterface
{
    /**
     * @var Request
     */
    protected $currentRequest;

    abstract protected function validateParameter(string $key): void;

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

    public function __construct(RequestStack $requestStack)
    {
        $this->setCurrentRequest($requestStack);
        $this->validateCurrentRequestKeys();
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Parameter\GetParameterServiceInterface::hasParameter()
     */
    public function hasParameter(string $key): bool
    {
        $this->validateParameter($key);

        return $this->currentRequest->query->has($key);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Parameter\GetParameterServiceInterface::getParameter()
     */
    public function getParameter(string $key)
    {
        $this->validateParameter($key);
        if ($this->hasParameter($key)) {
            return $this->currentRequest->get($key);
        }
        throw new NotSetElementException("The parameter <<$key>> is not defined!");
    }
}
