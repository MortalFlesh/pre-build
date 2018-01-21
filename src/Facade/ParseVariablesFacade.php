<?php

namespace MF\PreBuild\Facade;

use MF\PreBuild\Service\GitParser;
use MF\PreBuild\Service\VariablesExporter;

class ParseVariablesFacade
{
    /** @var ConfigReader */
    private $configReader;

    /** @var GitParser */
    private $gitParser;

    /** @var VariablesExporter */
    private $variablesExporter;

    public function __construct(ConfigReader $configReader, GitParser $gitParser, VariablesExporter $variablesExporter)
    {
        $this->configReader = $configReader;
        $this->gitParser = $gitParser;
        $this->variablesExporter = $variablesExporter;
    }

    public function parseVariables(string $configPath): void
    {
        $config = $this->configReader->readConfig($configPath);

        $gitValues = $this->gitParser->parseGitValues($config);

        $this->variablesExporter
            ->addSource($gitValues)
            ->export();
    }
}
