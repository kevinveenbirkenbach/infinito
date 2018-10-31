<?php

namespace App\Tests\Unit\Entity\Meta;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\Reciever;
use App\Entity\Meta\RecieverInterface;
use Doctrine\Common\Collections\Collection;

class RecieverTest extends TestCase
{
    /**
     * @var RecieverInterface
     */
    public $reciever;

    public function setUp(): void
    {
        $this->reciever = new Reciever();
    }

    public function testConstructor(): void
    {
        $this->assertInstanceOf(Collection::class, $this->reciever->getMembers());
    }
}
