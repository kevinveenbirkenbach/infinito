<?php

namespace App\Domain\SecureLoadManagement;

use App\Entity\Source\SourceInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @author kevinfrantz
 */
interface SecureSourceLoaderInterface
{
    /**
     * @throws AccessDeniedHttpException
     *
     * @return SourceInterface
     */
    public function getSource(): SourceInterface;
}
