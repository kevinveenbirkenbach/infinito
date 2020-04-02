<?php

namespace Infinito\Domain\Fixture\FixtureSource;

use Infinito\Domain\Fixture\EntityTemplateFactory;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Entity\Source\SourceInterface;

/**
 * This class containes the guest user.
 *
 * @author kevinfrantz
 */
final class GuestUserFixtureSource extends AbstractFixtureSource
{
    /**
     * @var string
     */
    protected $name = 'guest user';

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\Fixture\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $userSource = new UserSource();
        $userSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($userSource);

        return $userSource;
    }

    public static function getIcon(): string
    {
        return 'fas fa-user';
    }
}
