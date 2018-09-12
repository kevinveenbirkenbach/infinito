<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author kevinfrantz
 */
interface SourceControllerInterface extends CreationInterface, ActivationInterface, ModificationInterface
{
    public function show(int $id): Response;
}
