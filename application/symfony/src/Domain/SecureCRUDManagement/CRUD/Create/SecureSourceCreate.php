<?php

namespace App\Domain\SecureCRUDManagement\CRUD\Create;

use App\Entity\EntityInterface;
use App\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
final class SecureSourceCreate extends AbstractSecureCreate
{
    /**
     * {@inheritdoc}
     *
     * @see \App\Domain\SecureCRUDManagement\CRUD\Create\SecureCreatorInterface::create()
     */
    public function create(): EntityInterface
    {
        $source = new TextSource();
        $source->setText('Hello World!');

        return $source;
    }
}
