<?php

namespace MF\PreBuild\Facade;

use Assert\Assertion;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use Symfony\Component\Yaml\Yaml;

class ConfigReader
{
    /** @var Yaml */
    private $yaml;

    public function __construct(Yaml $yaml)
    {
        $this->yaml = $yaml;
    }

    public function readConfig(string $configPath): Config
    {
        $config = $this->parseConfig($configPath);
        list('parse' => $parse) = $config;

        $gitConfig = $this->parseGitConfig($parse);

        return new Config($gitConfig);
    }

    private function parseConfig(string $configPath): array
    {
        Assertion::file($configPath, 'Config file must be readable.');

        return $this->yaml->parse(file_get_contents($configPath))['pre-build'];
    }

    private function parseGitConfig(array $parse): GitConfig
    {
        return new GitConfig($parse['git']);
    }
}
