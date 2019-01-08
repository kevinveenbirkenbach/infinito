<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Create;

use App\Entity\EntityInterface;
use App\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
final class SecureSourceCreateService extends AbstractSecureCreateService
{
    /**
     * @return EntityInterface
     */
    public function create(): EntityInterface
    {
        $source = new TextSource();
        $source->setText('Hello World!');

        return $source;
    }
}
