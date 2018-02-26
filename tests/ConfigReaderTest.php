<?php

namespace MF\PreBuild\Tests;

use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
use MF\PreBuild\Service\ConfigReader;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Yaml\Yaml;

/**
 * @group unit
 */
class ConfigReaderTest extends TestCase
{
    private $configReader;

    public function setUp()
    {
        $this->configReader = new ConfigReader(new Yaml());
    }

    public function testShouldReadEmptyConfig()
    {
        $emptyConfig = new Config(null, null);

        $config = $this->configReader->readConfig(__DIR__ . '/Fixtures/.pre-build-empty.yml');

        $this->assertEquals($emptyConfig, $config);
    }

    public function testShouldReadGitConfig()
    {
        $gitConfig = new GitConfig([
            'commit' => 'GIT_COMMIT',
            'url' => 'GIT_URL',
            'branch' => 'GIT_BRANCH',
        ]);

        $config = $this->configReader->readConfig(__DIR__ . '/Fixtures/.pre-build.yml');

        $this->assertEquals($gitConfig, $config->getGitConfig());
    }

    public function testShouldReadMd5SumConfig()
    {
        $md5SumConfig = new Md5SumConfig([
            'tests/Fixtures/Md5/style.css' => 'CSSVER',
            'tests/Fixtures/Md5/index.js' => 'JSVER',
        ]);

        $config = $this->configReader->readConfig(__DIR__ . '/Fixtures/.pre-build.yml');

        $this->assertEquals($md5SumConfig, $config->getMd5SumConfig());
    }
}
