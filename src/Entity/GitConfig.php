<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class GitConfig
{
    public function __construct(private array $values)
    {
    }

    public function getValues(): iterable
    {
        return $this->values;
    }
}
