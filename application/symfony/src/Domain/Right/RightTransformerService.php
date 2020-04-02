<?php

namespace Infinito\Domain\Right;

use Infinito\Domain\Method\MethodPrefixType;
use Infinito\Domain\Request\Right\RequestedRightInterface;
use Infinito\Entity\Meta\Right;
use Infinito\Entity\Meta\RightInterface;

/**
 * @author kevinfrantz
 */
final class RightTransformerService implements RightTransformerServiceInterface
{
    private function getAttributByMethodName(string $method): string
    {
        return substr($method, 3);
    }

    private function isNameSetter(string $name): bool
    {
        return MethodPrefixType::GET === substr($name, 0, 3);
    }

    /**
     * @param RightInterface|RequestedRightInterface $right
     *
     * @return array|string[]
     */
    private function getAllAttributes($right): array
    {
        $attributes = [];
        $reflection = new \ReflectionClass($right);
        $methods = $reflection->getMethods(\ReflectionMethod::IS_PUBLIC);
        /*
         * @var \ReflectionMethod
         */
        foreach ($methods as $method) {
            $name = $method->getName();
            if ($this->isNameSetter($name)) {
                $attributes[] = $this->getAttributByMethodName($name);
            }
        }

        return $attributes;
    }

    private function getAttributesExistInBoth(RightInterface $right, RequestedRightInterface $requestedRight): array
    {
        $attributes = [];
        $requestedRightAttributes = $this->getAllAttributes($requestedRight);
        $rightAttributes = $this->getAllAttributes($right);
        foreach ($requestedRightAttributes as $requestedRightAttribut) {
            if (in_array($requestedRightAttribut, $rightAttributes)) {
                $attributes[] = $requestedRightAttribut;
            }
        }

        return $attributes;
    }

    private function hasMethod(string $name, object $object): bool
    {
        $reflection = new \ReflectionClass($object);

        return $reflection->hasMethod($name);
    }

    private function createMethod(string $prefix, string $attribute): string
    {
        return $prefix.ucfirst($attribute);
    }

    private function isAttributeGetPossible(string $attribute, object $object)
    {
        $has = $this->createMethod(MethodPrefixType::HAS, $attribute);
        if ($this->hasMethod($has, $object)) {
            $get = $this->createMethod(MethodPrefixType::GET, $attribute);

            return $object->{$get}();
        }

        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Right\RightTransformerServiceInterface::transform()
     */
    public function transform(RequestedRightInterface $requestedRight): RightInterface
    {
        $right = new Right();
        $attributes = $this->getAttributesExistInBoth($right, $requestedRight);
        foreach ($attributes as $attribute) {
            if ($this->isAttributeGetPossible($attribute, $requestedRight)) {
                $get = $this->createMethod(MethodPrefixType::GET, $attribute);
                $set = $this->createMethod(MethodPrefixType::SET, $attribute);
                $origine = $requestedRight->{$get}();
                $right->{$set}($origine);
            }
        }

        return $right;
    }
}
