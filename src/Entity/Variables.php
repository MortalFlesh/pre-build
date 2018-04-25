<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

use MF\Collection\Mutable\Generic\Map;

class Variables extends Map
{
    public function __construct()
    {
        parent::__construct('string', 'string');
    }
}
