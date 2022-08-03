<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use MF\PreBuild\Service\GitProcess;

class GitCommit implements GitCommandInterface
{
    public function execute(GitProcess $git): string
    {
        $commit = $git->git('rev-parse', 'HEAD');

        return trim($commit);
    }
}
