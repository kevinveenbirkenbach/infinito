<?php

namespace App\Domain\RequestManagement\Entity;

use App\Entity\AbstractEntity;
use App\Attribut\SlugAttribut;

/**
 * @author kevinfrantz
 */
class RequestedEntity extends AbstractEntity implements RequestedEntityInterface
{
    use SlugAttribut;

    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\RequestManagement\Entity\RequestedEntityInterface::setIdentity()
     */
    public function setIdentity($identity): void
    {
        if (is_numeric($identity)) {
            $this->setId($identity);
            $this->slug = null;

            return;
        }
        $this->setSlug($identity);
        $this->id = null;
    }
}
