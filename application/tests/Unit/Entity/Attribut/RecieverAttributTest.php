<?php
namespace Tests\Unit\Entity\Attribut;

use PHPUnit\Framework\TestCase;
use App\Entity\Attribut\RecieverAttributInterface;
use App\Entity\Attribut\RecieverAttribut;
use App\Entity\Meta\RecieverInterface;

class RecieverAttributTest extends TestCase
{
    /**
     * 
     * @var RecieverAttributInterface
     */
    protected $reciever;
    
    public function setUp():void{
        $this->reciever = new class implements RecieverAttributInterface{
            use RecieverAttribut;
        };
    }
    
    public function testConstructor():void{
        $this->expectException(\TypeError::class);
        $this->reciever->getReciever();
    }
    
    public function testAccessors():void{
        $reciever = $this->createMock(RecieverInterface::class);
        $this->assertNull($this->reciever->setReciever($reciever));
        $this->assertEquals($reciever, $this->reciever->getReciever());
    }
}

