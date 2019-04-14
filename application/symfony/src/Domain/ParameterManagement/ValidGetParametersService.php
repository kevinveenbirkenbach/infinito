<?php

namespace Infinito\Domain\ParameterManagement;

use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Infinito\Exception\Validation\GetParameterInvalidException;

/**
 * @author kevinfrantz
 */
final class ValidGetParametersService extends AbstractGetParameterService implements ValidGetParameterServiceInterface
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
     * @param string $key
     */
    protected function validateParameter(string $key): void
    {
        $parameter = $this->parameterFactory->getParameter($key);
        $parameter->setValue($this->currentRequest->get($key));
        $errors = $this->validator->validate($parameter);
        foreach ($errors as $error) {
            throw new GetParameterInvalidException("Parameter <<$key>> didn't pass the validation; Message: <<".$error->getMessage().'>> ,Value: <<'.$parameter->getValue().'>> .');
        }
    }
}
