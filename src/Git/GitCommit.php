<?php

namespace MF\PreBuild\Git;

use GitWrapper\GitWrapper;

class GitCommit implements GitCommandInterface
{
    public function execute(GitWrapper $git): string
    {
        $commit = $git->git('rev-parse HEAD');

        return trim($commit);
    }
}
