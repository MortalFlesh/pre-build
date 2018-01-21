<?php

namespace MF\PreBuild\Git;

use GitWrapper\GitWrapper;

class GitUrl implements GitCommandInterface
{
    public function execute(GitWrapper $git): string
    {
        $url = $git->git('config --get remote.origin.url');

        return trim($url);
    }
}
