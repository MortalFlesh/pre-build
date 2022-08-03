<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use MF\PreBuild\Service\GitProcess;

class GitTag implements GitCommandInterface
{
    public function execute(GitProcess $git): string
    {
        $tag = $git->git('describe', '--tags', '--abbrev=0');

        return trim($tag);
    }
}
