<?php

namespace MF\PreBuild\Facade;

use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Service\ConfigReader;
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

    public function parseVariables(string $configPath): Variables
    {
        $config = $this->configReader->readConfig($configPath);

        $gitValues = $this->gitParser->parseGitValues($config);

        return $this->variablesExporter
            ->addSource($gitValues)
            ->export();
    }
}
