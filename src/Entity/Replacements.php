<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

use MF\Collection\Mutable\Generic\ListCollection;

class Replacements extends ListCollection
{
    public function __construct()
    {
        parent::__construct(ReplacePlaceholder::class);
    }
}
