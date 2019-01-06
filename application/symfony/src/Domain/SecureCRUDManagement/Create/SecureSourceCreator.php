<?php

namespace App\Domain\SecureCRUDManagement\Create;

use App\Entity\EntityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use App\Entity\Source\Primitive\Text\TextSource;

/**
 * @author kevinfrantz
 *
 * @todo Implement!
 */
class SecureSourceCreator extends AbstractSecureCreator implements SecureSourceCreatorInterface
{
    public function __construct(Request $request, Security $security)
    {
    }

    public function create(): EntityInterface
    {
        $source = new TextSource();
        $source->setText('Hello World!');

        return $source;
    }
}
