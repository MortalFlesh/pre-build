<?php

namespace MF\PreBuild\Service;

use Assert\Assertion;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
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

        return new Config(
            $parse['git'] ? $this->parseGitConfig($parse) : null,
            $parse['md5sum'] ? $this->parseMd5Config($parse) : null
        );
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

    private function parseMd5Config(array $parse): Md5SumConfig
    {
        return new Md5SumConfig($parse['md5sum']);
    }
}
