<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use MF\PreBuild\Service\GitProcess;

interface GitCommandInterface
{
    public function execute(GitProcess $git): string;
}
