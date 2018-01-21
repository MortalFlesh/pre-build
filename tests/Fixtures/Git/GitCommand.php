<?php

namespace MF\PreBuild\Tests\Fixtures\Git;

use GitWrapper\GitWrapper;
use MF\PreBuild\Git\GitCommandInterface;

class GitCommand implements GitCommandInterface
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function execute(GitWrapper $git): string
    {
        return $this->value;
    }
}
