<?php

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
