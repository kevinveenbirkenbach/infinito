<?php

namespace tests\Integration\Attribut;

use PHPUnit\Framework\TestCase;

/**
 * This class is not a "real" integration test.
 * It just checks if the traits are build up on a valid way
 * It implements the schema described in.
 *
 * @see https://github.com/KevinFrantz/infinito/blob/master/application/symfony/src/Attribut/README.md
 *
 * @author kevinfrantz
 */
class AttributIntegrationTest extends TestCase
{
    /**
     * @var string The folder of the attributes
     */
    const FOLDER = __DIR__.'/../../../src/Attribut';

    /**
     * @var string The namespace of the attributs
     */
    const NAMESPACE = 'Infinito\\Attribut';

    /**
     * @var string
     */
    const INTERFACE_SUFFIX = 'Interface';

    /**
     * @var string
     */
    const ATTRIBUT_SUFFIX = 'Attribut';

    /**
     * @var string
     */
    const CONCAT_INTERFACE_SUFFIX = self::ATTRIBUT_SUFFIX.self::INTERFACE_SUFFIX;

    /**
     * @var array
     */
    const POSSIBLE_METHODS = ['has', 'get', 'set'];

    /**
     * @var array
     */
    const NECCESSARY_METHODS = ['get', 'set'];

    /**
     * @param string $file
     *
     * @return bool True if it is an interface
     */
    private function isInterface(\ReflectionClass $interface): bool
    {
        return $interface->isInterface();
    }

    private function getTraitName(\ReflectionClass $interface): string
    {
        return substr($interface->getName(), 0, -strlen(self::INTERFACE_SUFFIX));
    }

    private function validateHasTrait(\ReflectionClass $interface): void
    {
        $interfaceName = $interface->getName();
        $trait = $this->getTraitName($interface);
        $this->assertTrue(trait_exists($trait), "Trait <<$trait>> for interface <<$interfaceName>> MUST exist!");
    }

    private function validateHasInterface(\ReflectionClass $trait): void
    {
        $traitName = $trait->getName();
        $interface = $traitName.self::INTERFACE_SUFFIX;
        $this->assertTrue(interface_exists($interface), "Interface <<$interface>> for trait <<$traitName>> does not exist!");
    }

    private function getAttributName(\ReflectionClass $interface): string
    {
        return substr($interface->getShortName(), 0, -strlen(self::CONCAT_INTERFACE_SUFFIX));
    }

    private function getConstantName(\ReflectionClass $interface): string
    {
        $name = strtoupper($this->getAttributName($interface));

        return $name.'_ATTRIBUT_NAME';
    }

    private function validateConstants(\ReflectionClass $interface): void
    {
        $constants = $interface->getConstants();
        $constantAmount = count($constants);
        $this->assertTrue($constantAmount <= 1, 'Just one constant is allowed!');
        if (1 === $constantAmount) {
            $this->assertEquals($this->getConstantName($interface), array_keys($constants)[0]);
        }
    }

    private function validateMethods(\ReflectionClass $interface): void
    {
        $methods = get_class_methods($interface->getName());
        $possibleMethods = $this->getPossibleMethods($interface);
        foreach ($methods as $method) {
            $this->assertContains($method, $possibleMethods);
        }
        $neccessaryMethods = $this->getNeccessaryMethods($interface);
        foreach ($neccessaryMethods as $neccessaryMethod) {
            $this->assertContains($neccessaryMethod, $methods);
        }
    }

    private function getNeccessaryMethods(\ReflectionClass $interface): array
    {
        $possibleMethods = [];
        $name = $this->getAttributName($interface);
        foreach (self::NECCESSARY_METHODS as $method) {
            $possibleMethods[] = $method.$name;
        }

        return $possibleMethods;
    }

    private function getPossibleMethods(\ReflectionClass $interface): array
    {
        $possibleMethods = [];
        $name = $this->getAttributName($interface);
        foreach (self::POSSIBLE_METHODS as $method) {
            $possibleMethods[] = $method.$name;
        }

        return $possibleMethods;
    }

    private function getReflectionClass(string $file): \ReflectionClass
    {
        $shortName = substr($file, 0, -strlen('.php'));
        $name = self::NAMESPACE.'\\'.$shortName;

        return new \ReflectionClass($name);
    }

    private function validateTraitSchema(\ReflectionClass $interface): void
    {
        $trait = $this->getTraitName($interface);
        $traitMethods = get_class_methods($trait);
        $interfaceMethods = get_class_methods($interface->getName());
        foreach ($interfaceMethods as $interfaceMethod) {
            $this->assertContains($interfaceMethod, $traitMethods);
        }
    }

    public function testFiles(): void
    {
        $files = scandir(self::FOLDER);
        foreach ($files as $file) {
            if (!in_array($file, ['README.md', '.', '..'])) {
                $reflection = $this->getReflectionClass($file);
                if ($this->isInterface($reflection)) {
                    $this->validateHasTrait($reflection);
                    $this->validateConstants($reflection);
                    $this->validateMethods($reflection);
                    $this->validateTraitSchema($reflection);
                } else {
                    $this->validateHasInterface($reflection);
                }
            }
        }
    }
}
