<?php declare(strict_types=1);

namespace MF\PreBuild\Fixtures\Git;

use GitWrapper\GitWrapper;
use MF\PreBuild\Git\GitCommandInterface;

class GitCommand implements GitCommandInterface
{
    public function __construct(private string $value)
    {
    }

    public function execute(GitWrapper $git): string
    {
        return $this->value;
    }
}
