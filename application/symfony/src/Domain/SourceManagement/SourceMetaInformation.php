<?php

namespace App\Domain\SourceManagement;

use App\Domain\EntityManagement\EntityMetaInformation;
use App\Entity\Source\AbstractSource;
use App\Exception\NotCorrectInstanceException;

/**
 * @author kevinfrantz
 */
final class SourceMetaInformation extends EntityMetaInformation implements SourceMetaInformationInterface
{
    const UNPURE = 'source';

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformation::__construct()
     *
     * @param $entity AbstractSource
     */
    public function __construct(\App\Entity\EntityInterface $entity)
    {
        if (!$entity instanceof AbstractSource) {
            throw new NotCorrectInstanceException('Entity has to be an instance of '.AbstractSource::class);
        }
        parent::__construct($entity);
    }

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformation::setPureName()
     */
    protected function setPureName(): void
    {
        parent::setPureName();
        $this->pureName = substr($this->pureName, 0, -strlen(self::UNPURE));
    }
}
