<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class Md5SumConfig
{
    public function __construct(private array $values)
    {
    }

    public function getValues(): array
    {
        return $this->values;
    }
}
