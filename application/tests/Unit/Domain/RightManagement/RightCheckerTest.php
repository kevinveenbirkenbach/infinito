<?php
namespace Tests\Unit\Domain\RightManagement;

use PHPUnit\Framework\TestCase;
use App\Entity\Meta\RightInterface;
use App\Entity\Meta\Right;
use App\Entity\Source\SourceInterface;
use App\Entity\Source\AbstractSource;
use App\DBAL\Types\LayerType;
use App\Domain\RightManagement\RightCheckerInterface;
use App\Domain\RightManagement\RightChecker;
use App\DBAL\Types\RightType;

class RightCheckerTest extends TestCase
{
    /**
     * @var SourceInterface
     */
    private $source;
    
    /**
     * @var RightInterface
     */
    private $right;
    
    /**
     * @var RightCheckerInterface
     */
    private $rightManager;
    
    private function getSourceMock():SourceInterface{
        return new class extends AbstractSource{};
    }
    
    public function setUp():void{
        $this->right = new Right();
        $this->source = $this->getSourceMock();
        $this->right->setSource($this->source);
        $this->rightManager = new RightChecker($this->right);
    }
    
    public function testFirstDimension():void{
        $layer = LayerType::RELATION;
        $type = RightType::READ;
        $this->right->setType($type);
        $this->right->setLayer($layer);
        $granted = $this->rightManager->isGranted($layer, $type, $this->source);
        $this->assertTrue($granted);
        $notGranted = $this->rightManager->isGranted(LayerType::SOURCE, $type, $this->source);
        $this->assertFalse($notGranted);
        $notGranted2 = $this->rightManager->isGranted($layer, RightType::WRITE, $this->source);
        $this->assertFalse($notGranted2);
        $this->right->setGrant(false);
        $notGranted3 = $this->rightManager->isGranted($layer, $type, $this->source);
        $this->assertFalse($notGranted3);
    }
    
//     public function testSecondDimension():void{
        
//     }
}