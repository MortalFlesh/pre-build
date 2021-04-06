<?php declare(strict_types=1);

namespace MF\PreBuild\Facade;

use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Service\ConfigReader;
use MF\PreBuild\Service\GitParser;
use MF\PreBuild\Service\Md5Sum;
use MF\PreBuild\Service\VariablesExporter;

class ParseVariablesFacade
{
    public function __construct(
        private ConfigReader $configReader,
        private GitParser $gitParser,
        private VariablesExporter $variablesExporter,
        private Md5Sum $md5Sum
    ) {
    }

    public function parseVariables(string $configPath): Variables
    {
        $config = $this->configReader->readConfig($configPath);

        return $this->variablesExporter
            ->addSource($this->gitParser->parseGitValues($config))
            ->addSource($this->md5Sum->findMd5Sum($config))
            ->export();
    }
}
