<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use Assert\Assertion;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
use function safe\file_get_contents;
use Symfony\Component\Yaml\Yaml;

class ConfigReader
{
    public function readConfig(string $configPath): Config
    {
        $config = $this->parseConfig($configPath);
        $parse = $config['parse'] ?? [];

        return new Config(
            array_key_exists('git', $parse) ? $this->parseGitConfig($parse) : null,
            array_key_exists('md5sum', $parse) ? $this->parseMd5Config($parse) : null,
        );
    }

    private function parseConfig(string $configPath): array
    {
        Assertion::file($configPath, 'Config file must be readable.');

        $config = Yaml::parse(file_get_contents($configPath));

        Assertion::isArray($config);

        return $config['pre-build'];
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
