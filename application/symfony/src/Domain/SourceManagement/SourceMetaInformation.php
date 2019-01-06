<?php

namespace App\Domain\SourceManagement;

use App\Domain\EntityManagement\EntityMetaInformation;

/**
 * @author kevinfrantz
 */
final class SourceMetaInformation extends EntityMetaInformation implements SourceMetaInformationInterface
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\EntityManagement\EntityMetaInformation::setPureName()
     */
    protected function setPureName(): void
    {
        parent::setPureName();
        $this->pureName = str_replace('Source', '', $this->pureName);
    }
}
