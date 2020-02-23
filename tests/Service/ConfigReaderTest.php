<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class ConfigReaderTest extends TestCase
{
    /** @var ConfigReader */
    private $configReader;

    protected function setUp(): void
    {
        $this->configReader = new ConfigReader();
    }

    public function testShouldReadEmptyConfig(): void
    {
        $emptyConfig = new Config(null, null);

        $config = $this->configReader->readConfig(__DIR__ . '/../Fixtures/.pre-build-empty.yml');

        $this->assertEquals($emptyConfig, $config);
    }

    public function testShouldReadGitConfig(): void
    {
        $gitConfig = new GitConfig([
            'commit' => 'GIT_COMMIT',
            'url' => 'GIT_URL',
            'branch' => 'GIT_BRANCH',
        ]);

        $config = $this->configReader->readConfig(__DIR__ . '/../Fixtures/.pre-build.yml');

        $this->assertEquals($gitConfig, $config->getGitConfig());
    }

    public function testShouldReadMd5SumConfig(): void
    {
        $md5SumConfig = new Md5SumConfig([
            'tests/Fixtures/Md5/style.css' => 'CSSVER',
            'tests/Fixtures/Md5/index.js' => 'JSVER',
        ]);

        $config = $this->configReader->readConfig(__DIR__ . '/../Fixtures/.pre-build.yml');

        $this->assertEquals($md5SumConfig, $config->getMd5SumConfig());
    }
}
