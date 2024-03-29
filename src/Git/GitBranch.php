<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use MF\PreBuild\Service\GitProcess;

class GitBranch implements GitCommandInterface
{
    /** @see https://stackoverflow.com/questions/6245570/how-to-get-the-current-branch-name-in-git */
    public function execute(GitProcess $git): string
    {
        $branch = $git->git('rev-parse', '--abbrev-ref', 'HEAD');

        return trim($branch);
    }
}
