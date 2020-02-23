<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class ReplacePlaceholder
{
    /** @var string */
    private $file;

    /** @var string */
    private $placeholder;

    /** @var string */
    private $value;

    public function __construct(string $file, string $placeholder, string $value)
    {
        $this->file = $file;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }
}
