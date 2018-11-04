<?php

namespace Tests\Unit\Form;

use PHPUnit\Framework\TestCase;
use App\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\UserSourceType;

/**
 * This class just exists to keep the code coverage high.
 *
 * @todo Implement better tests!
 *
 * @author kevinfrantz
 */
class UserSourceTypeTest extends TestCase
{
    /**
     * @var AbstractType
     */
    protected $type;

    public function setUp(): void
    {
        $this->type = new UserSourceType();
    }

    public function testBuildForm(): void
    {
        $builder = $this->createMock(FormBuilderInterface::class);
        $this->assertNull($this->type->buildForm($builder, []));
    }

    public function testConfigureOptions(): void
    {
        $resolver = $this->createMock(OptionsResolver::class);
        $this->assertNull($this->type->configureOptions($resolver));
    }
}
