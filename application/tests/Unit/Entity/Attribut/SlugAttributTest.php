<?php

namespace Tests\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\SlugAttributInterface;
use App\Entity\Attribut\SlugAttribut;

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
        $this->expectException(\TypeError::class);
        $this->slugAttribut->getSlug();
    }

    public function testAccessors(): void
    {
        $slug = 'goodslug';
        $this->assertNull($this->slugAttribut->setSlug($slug));
        $this->assertEquals($slug, $this->slugAttribut->getSlug());
    }
}
