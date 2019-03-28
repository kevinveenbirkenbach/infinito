<?php

namespace Infinito\Domain\ParameterManagement;

use Infinito\Exception\UnvalidParameterException;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author kevinfrantz
 */
final class ValidGetParametersService extends OptionalGetParameterService implements ValidGetParameterServiceInterface
{
    /**
     * @var ParameterFactoryInterface
     */
    private $parameterFactory;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(RequestStack $requestStack, ParameterFactoryInterface $parameterFactory, ValidatorInterface $validator)
    {
        $this->parameterFactory = $parameterFactory;
        $this->validator = $validator;
        parent::__construct($requestStack);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\ParameterManagement\OptionalGetParameterService::validateParameter()
     */
    protected function validateParameter(string $key): void
    {
        parent::validateParameter($key);
        $parameter = $this->parameterFactory->getParameter($key);
        $errors = $this->validator->validate($parameter);
        if (count($errors) > 0) {
            throw new UnvalidParameterException("Parameter <<$key>> didn't pass the validation");
        }
    }
}
