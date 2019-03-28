<?php

namespace Infinito\Domain\ParameterManagement;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Infinito\Exception\UnvalidGetParameterException;

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

    /**
     * @param RequestStack              $requestStack
     * @param ParameterFactoryInterface $parameterFactory
     * @param ValidatorInterface        $validator
     */
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
        $parameter = $this->parameterFactory->getParameter($key);
        $parameter->setValue($this->currentRequest->get($key));
        $errors = $this->validator->validate($parameter);
        foreach ($errors as $error) {
            throw new UnvalidGetParameterException("Parameter <<$key>> didn't pass the validation; Message: <<".$error->getMessage().'>> ,Value: <<'.$parameter->getValue().'>> .');
        }
    }
}
