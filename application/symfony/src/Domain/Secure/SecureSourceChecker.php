<?php

namespace Infinito\Domain\Secure;

use Infinito\Entity\Meta\RightInterface;
use Infinito\Entity\Source\SourceInterface;
use Infinito\Domain\Law\LawPermissionChecker;
use Infinito\Exception\Permission\NoSourcePermissionException;
use Infinito\Domain\Method\MethodPrefixType;

/**
 * @author kevinfrantz
 */
final class SecureSourceChecker implements SecureSourceCheckerInterface
{
    /**
     * @var SourceInterface
     */
    private $source;

    /**
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * @param string $methodName
     *
     * @return bool
     */
    private function isGetter(string $methodName): bool
    {
        return MethodPrefixType::GET === substr($methodName, 0, 3);
    }

    /**
     * @param mixed $value
     *
     * @return bool
     */
    private function isSource($value): bool
    {
        return $value instanceof SourceInterface;
    }

    /**
     * @param string $methodName
     *
     * @return SourceInterface|null
     */
    private function getExpectedSource(string $methodName): ?SourceInterface
    {
        try {
            return $this->source->{$methodName}();
        } catch (\TypeError $typeError) {
            return null;
        }
    }

    /**
     * @param RightInterface $requestedRight
     *
     * @throws NoSourcePermissionException It's important to fire this exception to reduce complexity in debuging
     *
     * @return bool
     */
    private function itterateOverSourceAttributs(RightInterface $requestedRight): bool
    {
        foreach (get_class_methods($this->source) as $methodName) {
            if ($this->isGetter($methodName)) {
                $attributExpectedSource = $this->getExpectedSource($methodName);
                if ($attributExpectedSource) {
                    $requestedSubSourceRight = clone $requestedRight;
                    $requestedSubSourceRight->setSource($attributExpectedSource);
                    if ($this->isSource($attributExpectedSource)) {
                        $methodSecureSourceChecker = new self($attributExpectedSource);
                        if (!$methodSecureSourceChecker->hasPermission($requestedSubSourceRight)) {
                            throw new NoSourcePermissionException('Access denied for subsource!');
                        }
                    }
                }
            }
        }

        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Secure\SecureSourceCheckerInterface::hasPermission()
     */
    public function hasPermission(RightInterface $requestedRight): bool
    {
        $law = new LawPermissionChecker($this->source->getLaw());

        return $law->hasPermission($requestedRight) && $this->itterateOverSourceAttributs($requestedRight);
    }
}
