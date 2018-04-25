<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class GitConfig
{
    /** @var array */
    private $values;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    public function getValues(): iterable
    {
        return $this->values;
    }
}
