<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use GitWrapper\GitWrapper;

interface GitCommandInterface
{
    public function execute(GitWrapper $git): string;
}
