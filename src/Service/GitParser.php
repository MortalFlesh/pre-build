<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Git\GitCommandFactory;

class GitParser
{
    public function __construct(
        private GitProcess $gitProcess,
        private GitCommandFactory $gitCommandFactory,
    ) {
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

        return $gitCommand->execute($this->gitProcess);
    }
}
