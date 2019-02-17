<?php

namespace Infinito\Domain\SourceManagement;

use Infinito\Domain\EntityManagement\EntityMetaInformation;
use Infinito\Entity\Source\AbstractSource;
use Infinito\Exception\NotCorrectInstanceException;

/**
 * @author kevinfrantz
 */
final class SourceMetaInformation extends EntityMetaInformation implements SourceMetaInformationInterface
{
    const UNPURE = 'source';

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformation::__construct()
     *
     * @param $entity AbstractSource
     */
    public function __construct(\Infinito\Entity\EntityInterface $entity)
    {
        if (!$entity instanceof AbstractSource) {
            throw new NotCorrectInstanceException('Entity has to be an instance of '.AbstractSource::class);
        }
        parent::__construct($entity);
    }

    /**
     * {@inheritdoc}
     *
     * @see \Infinito\Domain\EntityManagement\EntityMetaInformation::setPureName()
     */
    protected function setPureName(): void
    {
        parent::setPureName();
        $this->pureName = substr($this->pureName, 0, -strlen(self::UNPURE));
    }
}
