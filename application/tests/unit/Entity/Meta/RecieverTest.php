<?php

namespace App\tests\unit\Entity\Meta;

use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;
use App\Entity\Meta\Reciever;
use App\Entity\Meta\RecieverInterface;

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
        $this->assertEquals(Collection::class, $this->reciever->getAllRecievers());
    }
}
