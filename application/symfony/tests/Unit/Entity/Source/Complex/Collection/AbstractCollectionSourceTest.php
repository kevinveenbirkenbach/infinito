<?php

namespace Tests\Unit\Entity\Source\Complex\Collection;

use Doctrine\Common\Collections\Collection;
use Infinito\Entity\Source\Complex\Collection\AbstractCollectionSource;
use Infinito\Entity\Source\Complex\Collection\CollectionSourceInterface;
use PHPUnit\Framework\TestCase;

class AbstractCollectionSourceTest extends TestCase
{
    /**
     * @var CollectionSourceInterface
     */
    public $collectionSource;

    public function setUp(): void
    {
        $this->collectionSource = new class() extends AbstractCollectionSource {
        };
    }

    public function testConstruct(): void
    {
        $this->assertInstanceOf(Collection::class, $this->collectionSource->getCollection());
    }
}
