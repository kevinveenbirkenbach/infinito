<?php

namespace tests\Unit\Domain\SourceManagement;

use App\Domain\SourceManagement\SourceClassInformationServiceInterface;
use App\Domain\SourceManagement\SourceClassInformationService;
use PHPUnit\Framework\TestCase;
use App\Entity\Source\PureSource;
use App\Entity\Source\Complex\AbstractComplexSource;

/**
 * @author kevinfrantz
 */
class SourceClassInformationServiceTest extends TestCase
{
    /**
     * @var SourceClassInformationServiceInterface
     */
    private $sourceClassInformationService;

    public function setUp(): void
    {
        $this->sourceClassInformationService = new SourceClassInformationService();
    }

    public function testPureSource(): void
    {
        $allClasses = $this->sourceClassInformationService->getAllSourceClasses();
        $this->assertTrue(in_array(PureSource::class, $allClasses));
    }

    public function testNotSource(): void
    {
        $allClasses = $this->sourceClassInformationService->getAllSourceClasses();
        $this->assertFalse(in_array('ALLALALABBBB', $allClasses));
    }

    public function testSubSource(): void
    {
        $allClasses = $this->sourceClassInformationService->getAllSubSourceClasses('App\\Entity\\Source\\Complex');
        $this->assertFalse(in_array(PureSource::class, $allClasses));
        $this->assertTrue(in_array(AbstractComplexSource::class, $allClasses));
    }
}
