<?php

namespace tests\unit\Entity\Source\Combination;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Data\PersonIdentitySourceInterface;
use App\Entity\Source\Data\PersonIdentitySource;
use App\Entity\Source\Combination\FullPersonNameSourceInterface;

class PersonIdentitySourceTest extends TestCase
{
    /**
     * @var PersonIdentitySourceInterface
     */
    public $identitySource;

    public function setUp(): void
    {
        $this->userSource = new PersonIdentitySource();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(FullPersonNameSourceInterface::class, $this->identitySource->getFullPersonNameSource());
    }
}
