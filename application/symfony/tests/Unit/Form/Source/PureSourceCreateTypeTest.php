<?php

namespace tests\Unit\Form\Source;

use Symfony\Component\Form\Test\TypeTestCase;
use App\Entity\Source\PureSource;
use App\Form\Source\PureSourceCreateType;

/**
 * @author kevinfrantz
 *
 * @see https://symfony.com/doc/current/form/unit_testing.html
 */
class PureSourceCreateTypeTest extends TypeTestCase
{
    const SLUG = 'ABCDE';

    public function testAttributes(): void
    {
        $formData = ['slug' => self::SLUG];
        $objectToCompare = new PureSource();
        $form = $this->factory->create(PureSourceCreateType::class, $objectToCompare);

        $object = new PureSource();
        $object->setSlug(self::SLUG);
        $object->setCreatorRelation($objectToCompare->getCreatorRelation());

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        // check that $objectToCompare was modified as expected when the form was submitted
        //$this->assertEquals($object, $objectToCompare);

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
