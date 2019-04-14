<?php

namespace Tests\Attribut;

use PHPUnit\Framework\TestCase;
use Infinito\Attribut\SlugAttributInterface;
use Infinito\Attribut\SlugAttribut;
use Infinito\Exception\Validation\ValueInvalidException;

/**
 * @author kevinfrantz
 */
class SlugAttributTest extends TestCase
{
    /**
     * @var SlugAttributInterface
     */
    protected $slugAttribut;

    public function setUp(): void
    {
        $this->slugAttribut = new class() implements SlugAttributInterface {
            use SlugAttribut;
        };
    }

    public function testConstructor(): void
    {
        $this->assertFalse($this->slugAttribut->hasSlug());
        $this->assertNull($this->slugAttribut->getSlug());
    }

    public function testAccessors(): void
    {
        $slug = 'goodslug';
        $this->assertNull($this->slugAttribut->setSlug($slug));
        $this->assertTrue($this->slugAttribut->hasSlug());
        $this->assertEquals($slug, $this->slugAttribut->getSlug());
        $this->assertNull($this->slugAttribut->setSlug(''));
        $this->assertTrue($this->slugAttribut->hasSlug());
    }

    public function testNumericSetException(): void
    {
        $this->expectException(ValueInvalidException::class);
        $this->slugAttribut->setSlug('1234');
    }
}
