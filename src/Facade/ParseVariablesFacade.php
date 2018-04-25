<?php declare(strict_types=1);

namespace MF\PreBuild\Facade;

use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Service\ConfigReader;
use MF\PreBuild\Service\GitParser;
use MF\PreBuild\Service\Md5Sum;
use MF\PreBuild\Service\VariablesExporter;

class ParseVariablesFacade
{
    /** @var ConfigReader */
    private $configReader;

    /** @var GitParser */
    private $gitParser;

    /** @var VariablesExporter */
    private $variablesExporter;

    /** @var Md5Sum */
    private $md5Sum;

    public function __construct(
        ConfigReader $configReader,
        GitParser $gitParser,
        VariablesExporter $variablesExporter,
        Md5Sum $md5Sum
    ) {
        $this->configReader = $configReader;
        $this->gitParser = $gitParser;
        $this->variablesExporter = $variablesExporter;
        $this->md5Sum = $md5Sum;
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
