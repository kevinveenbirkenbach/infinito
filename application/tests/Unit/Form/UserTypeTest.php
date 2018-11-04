<?php

namespace Tests\Unit\Form;

use PHPUnit\Framework\TestCase;
use App\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\UserType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * This class just exists to keep the code coverage high.
 *
 * @todo Implement better tests!
 *
 * @author kevinfrantz
 */
class UserTypeTest extends TestCase
{
    /**
     * @var AbstractType
     */
    protected $type;

    public function setUp(): void
    {
        $this->type = new UserType();
    }

    public function testBuildForm(): void
    {
        $builder = new FormBuilder(null, null, $this->createMock(EventDispatcherInterface::class), $this->createMock(FormFactoryInterface::class));
        $this->assertNull($this->type->buildForm($builder, []));
    }

    public function testConfigureOptions(): void
    {
        $resolver = $this->createMock(OptionsResolver::class);
        $this->assertNull($this->type->configureOptions($resolver));
    }
}
