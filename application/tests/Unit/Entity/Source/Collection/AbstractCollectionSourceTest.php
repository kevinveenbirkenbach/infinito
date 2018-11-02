<?php

namespace Tests\Unit\Entity\Source\Collection;

use PHPUnit\Framework\TestCase;
use App\Entity\Source\Collection\CollectionSourceInterface;
use App\Entity\Source\Collection\AbstractCollectionSource;
use Doctrine\Common\Collections\Collection;

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
