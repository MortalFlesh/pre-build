<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use Assert\Assertion;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
use MF\PreBuild\Entity\Md5SumReplaceConfig;
use function safe\file_get_contents;
use Symfony\Component\Yaml\Yaml;

class ConfigReader
{
    private const KEYS = ['parse', 'replace'];

    public function readConfig(string $configPath): Config
    {
        $config = $this->parseConfig($configPath);
        ['parse' => $parse, 'replace' => $replace] = $config;

        return new Config(
            $parse['git'] ? $this->parseGitConfig($parse) : null,
            $parse['md5sum'] ? $this->parseMd5Config($parse) : null,
            $replace['md5sum'] ? $this->parseReplaceMd5Config($replace) : null
        );
    }

    private function parseConfig(string $configPath): array
    {
        Assertion::file($configPath, 'Config file must be readable.');

        $config = Yaml::parse(file_get_contents($configPath));

        Assertion::isArray($config);
        $preBuildConfig = $config['pre-build'];

        foreach (self::KEYS as $key) {
            if (!array_key_exists($key, $preBuildConfig)) {
                $preBuildConfig[$key] = null;
            }
        }

        return $preBuildConfig;
    }

    private function parseGitConfig(array $parse): GitConfig
    {
        return new GitConfig($parse['git']);
    }

    private function parseMd5Config(array $parse): Md5SumConfig
    {
        return new Md5SumConfig($parse['md5sum']);
    }

    private function parseReplaceMd5Config(array $replace): Md5SumReplaceConfig
    {
        return new Md5SumReplaceConfig($replace['md5sum']);
    }
}
