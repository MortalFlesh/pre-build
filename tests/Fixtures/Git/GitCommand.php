<?php declare(strict_types=1);

namespace MF\PreBuild\Fixtures\Git;

use MF\PreBuild\Git\GitCommandInterface;
use MF\PreBuild\Service\GitProcess;

class GitCommand implements GitCommandInterface
{
    public function __construct(private string $value)
    {
    }

    public function execute(GitProcess $git): string
    {
        return $this->value;
    }
}
