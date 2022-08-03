<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use MF\PreBuild\Service\GitProcess;

class GitUrl implements GitCommandInterface
{
    public function execute(GitProcess $git): string
    {
        $url = $git->git('config', '--get', 'remote.origin.url');

        return trim($url);
    }
}
