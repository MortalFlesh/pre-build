<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

class GitCommandFactory
{
    private const GIT_COMMIT = 'commit';
    private const GIT_BRANCH = 'branch';
    private const GIT_URL = 'url';
    private const GIT_TAG = 'tag';

    public function createGitCommand(string $gitKey): GitCommandInterface
    {
        return match ($gitKey) {
            self::GIT_COMMIT => new GitCommit(),
            self::GIT_BRANCH => new GitBranch(),
            self::GIT_URL => new GitUrl(),
            self::GIT_TAG => new GitTag(),
            default => throw new \Exception(sprintf('Git command %s is not implemented yet.', __METHOD__)),
        };
    }
}
