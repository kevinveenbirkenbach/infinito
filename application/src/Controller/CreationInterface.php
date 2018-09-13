<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

/**
 * @author kevinfrantz
 */
interface CreationInterface
{
    public function create(): Response;

    public function delete(): Response;
}
