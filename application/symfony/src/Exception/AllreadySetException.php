<?php

namespace App\Exception;

use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

final class AllreadySetException extends ConflictHttpException
{
}
