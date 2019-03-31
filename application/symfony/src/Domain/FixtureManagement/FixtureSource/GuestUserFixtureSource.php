<?php

namespace Infinito\Domain\FixtureManagement\FixtureSource;

use Infinito\Entity\Source\SourceInterface;
use Infinito\Entity\Source\Complex\UserSource;
use Infinito\Domain\FixtureManagement\EntityTemplateFactory;

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
     * @see \Infinito\Domain\FixtureManagement\FixtureSource\FixtureSourceInterface::getORMReadyObject()
     */
    public function getORMReadyObject(): SourceInterface
    {
        $userSource = new UserSource();
        $userSource->setSlug(self::getSlug());
        EntityTemplateFactory::createStandartPublicRights($userSource);

        return $userSource;
    }

    /**
     * @return string
     */
    public static function getIcon(): string
    {
        return 'fas fa-user';
    }
}
