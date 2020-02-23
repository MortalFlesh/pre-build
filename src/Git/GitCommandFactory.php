<?php declare(strict_types=1);

namespace MF\PreBuild\Git;

use Assert\Assertion;

class GitCommandFactory
{
    private const GIT_COMMIT = 'commit';
    private const GIT_BRANCH = 'branch';
    private const GIT_URL = 'url';

    private const AVAILABLE_COMMANDS = [
        self::GIT_COMMIT,
        self::GIT_BRANCH,
        self::GIT_URL,
    ];

    public function createGitCommand(string $gitKey): GitCommandInterface
    {
        Assertion::inArray($gitKey, self::AVAILABLE_COMMANDS);

        switch ($gitKey) {
            case self::GIT_COMMIT:
                return new GitCommit();
            case self::GIT_BRANCH:
                return new GitBranch();
            case self::GIT_URL:
                return new GitUrl();
        }

        throw new \Exception(sprintf('Git command %s is not implemented yet.', __METHOD__));
    }
}
