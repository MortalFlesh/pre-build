<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class Md5SumReplaceConfig
{
    /** @var array */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getValues(): array
    {
        return $this->values;
    }
}
