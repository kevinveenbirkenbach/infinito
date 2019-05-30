<?php

namespace Infinito\Domain\Dom;

use Infinito\Entity\EntityInterface;
use Doctrine\Common\Collections\Collection;
use Infinito\Domain\RequestManagement\Entity\RequestedEntityServiceInterface;
use Infinito\DBAL\Types\Meta\Right\LayerType;
use Infinito\Domain\LayerManagement\LayerInterfaceMap;
use FOS\UserBundle\Model\UserInterface;
use Infinito\Exception\Core\NotCorrectInstanceCoreException;
use Infinito\Domain\MethodManagement\MethodPrefixType;

/**
 * This class is not ready and not tested!
 *
 * @todo Implement tests!
 * @todo finish class!
 * @todo refactor class!
 *
 * @author kevinfrantz
 */
final class EntityDomService implements EntityDomServiceInterface
{
    /**
     * @var RequestedEntityServiceInterface
     */
    private $requestedEntity;

    /**
     * @var EntityInterface
     */
    private $entity;

    /**
     * @var \ReflectionClass
     */
    private $entityReflectionClass;

    /**
     * @var array[]|\ReflectionProperty[]
     */
    private $properties = [];

    /**
     * @var \DOMDocument
     */
    private $domDocument;

    /**
     * @param RequestedEntityServiceInterface $requestedEntity
     */
    public function __construct(RequestedEntityServiceInterface $requestedEntity)
    {
        $this->requestedEntity = $requestedEntity;
    }

    private function createProperties(): void
    {
        $this->properties = $this->entityReflectionClass->getProperties();
    }

    private function createDomDocument(): void
    {
        $this->domDocument = new \DOMDocument();
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    private function methodExist(string $method): bool
    {
        return $this->entityReflectionClass->hasMethod($method);
    }

    /**
     * @param string $method
     *
     * @return mixed
     */
    private function getMethodResult(string $method)
    {
        return $this->entity->{$method}();
    }

    /**
     * @param string $propertyName
     *
     * @return mixed
     */
    private function getPropertyValue(string $propertyName)
    {
        $hasMethod = $this->getMethodName(MethodPrefixType::HAS, $propertyName);
        if ($this->methodExist($hasMethod) && !$this->getMethodResult($hasMethod)) {
            return null;
        }
        $getMethod = $this->getMethodName(MethodPrefixType::GET, $propertyName);
        $result = $this->getMethodResult($getMethod);

        return $result;
    }

    /**
     * @param mixed|EntityInterface $value
     * @param \DOMElement           $domElement
     */
    private function mappValue($value, \DOMElement $domElement): void
    {
        foreach (LayerInterfaceMap::getAllInterfaces() as $layer => $interface) {
            if ($value instanceof $interface) {
                $this->setLayerDomElement($domElement, $layer, $value);

                return;
            }
            if ($value instanceof UserInterface) {
                $this->setUserDomElement($domElement, $value);

                return;
            }
        }
        if (is_object($value)) {
            throw new NotCorrectInstanceCoreException('The instance '.get_class($value).' is not supported!');
        }
        $domElement->setAttribute('type', gettype($value));
        $domElement->setAttribute('value', $value);

        return;
    }

    /**
     * @param \DOMElement     $domElement
     * @param string          $layer
     * @param EntityInterface $entity
     */
    private function setLayerDomElement(\DOMElement $domElement, string $layer, EntityInterface $entity): void
    {
        $domElement->setAttribute('layer', $layer);
        $domElement->setAttribute('id', $entity->getId());
        $domElement->setAttribute('name', LayerType::getReadableValue($layer));
    }

    /**
     * @param \DomElement $domElement
     */
    private function setUserDomElement(\DomElement $domElement, \Infinito\Entity\UserInterface $user): void
    {
        $domElement->setAttribute('value', $user->getId());
        $domElement->setAttribute('name', 'user');
    }

    /**
     * @param string $method
     * @param string $propertyName
     *
     * @return string
     */
    private function getMethodName(string $method, string $propertyName): string
    {
        return $method.ucfirst($propertyName);
    }

    /**
     * @param string $propertyName
     *
     * @return bool
     */
    private function isPropertyAccessible(string $propertyName): bool
    {
        $getMethod = $this->getMethodName(MethodPrefixType::GET, $propertyName);

        return $this->entityReflectionClass->hasMethod($getMethod);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Dom\EntityDomServiceInterface::getDomDocument()
     */
    public function getDomDocument(): \DOMDocument
    {
        $this->entity = $this->requestedEntity->getEntity();
        $this->entityReflectionClass = new \ReflectionClass($this->entity);
        $this->createProperties();
        $this->createDomDocument();
        foreach ($this->properties as $property) {
            $propertyName = $property->getName();
            if ($this->isPropertyAccessible($propertyName)) {
                $domElement = $this->domDocument->createElement('attribut');
                $domElement->setAttribute('name', $propertyName);
                $value = $this->getPropertyValue($propertyName);
                if ($value instanceof Collection) {
                    foreach ($value as $valueElement) {
                        $domSubElement = $this->domDocument->createElement('list-element');
                        $domElement->setAttribute('name', $propertyName);
                        $this->mappValue($valueElement, $domSubElement);
                        $domElement->appendChild($domSubElement);
                    }
                } else {
                    $this->mappValue($value, $domElement);
                }
                $this->domDocument->appendChild($domElement);
            }
        }
        $this->domDocument->saveXML();

        return $this->domDocument;
    }
}
