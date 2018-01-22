<?php

namespace MF\PreBuild\Tests;

use MF\PreBuild\Entity\GitConfig;
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
}
