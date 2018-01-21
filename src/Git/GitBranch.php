<?php

namespace MF\PreBuild\Git;

use GitWrapper\GitWrapper;

class GitBranch implements GitCommandInterface
{
    /** @see https://stackoverflow.com/questions/6245570/how-to-get-the-current-branch-name-in-git */
    public function execute(GitWrapper $git): string
    {
        $branch = $git->git('rev-parse --abbrev-ref HEAD');

        return trim($branch);
    }
}
