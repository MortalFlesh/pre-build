<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use GitWrapper\GitWrapper;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Git\GitCommandFactory;

class GitParser
{
    /** @var GitWrapper */
    private $gitWrapper;

    /** @var GitCommandFactory */
    private $gitCommandFactory;

    public function __construct(GitWrapper $gitWrapper, GitCommandFactory $gitCommandFactory)
    {
        $this->gitWrapper = $gitWrapper;
        $this->gitCommandFactory = $gitCommandFactory;
    }

    public function parseGitValues(Config $config): Variables
    {
        $variables = new Variables();
        $gitConfig = $config->getGitConfig();

        if (!$gitConfig) {
            return $variables;
        }

        foreach ($gitConfig->getValues() as $gitKey => $envName) {
            $variables->set($envName, $this->parseFromGit($gitKey));
        }

        return $variables;
    }

    private function parseFromGit(string $gitKey): string
    {
        $gitCommand = $this->gitCommandFactory->createGitCommand($gitKey);

        return $gitCommand->execute($this->gitWrapper);
    }
}
