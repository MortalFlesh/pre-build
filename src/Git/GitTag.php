<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use GitWrapper\GitWrapper;

class GitTag implements GitCommandInterface
{
    public function execute(GitWrapper $git): string
    {
        $tag = $git->git('describe --tags --abbrev=0');

        return trim($tag);
    }
}
