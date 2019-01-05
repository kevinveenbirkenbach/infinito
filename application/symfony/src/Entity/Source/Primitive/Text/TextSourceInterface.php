<?php

namespace App\Entity\Source\Primitive\Text;

use App\Entity\Source\Primitive\PrimitiveSourceInterface;
use App\Entity\Attribut\TextAttributInterface;

interface TextSourceInterface extends PrimitiveSourceInterface, TextAttributInterface
{
}
