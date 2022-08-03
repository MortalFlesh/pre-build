<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Git\GitCommandFactory;
use PHPUnit\Framework\TestCase;

/**
 * @group local
 * @group unit
 */
class GitParserRealTest extends TestCase
{
    private GitParser $realGitParser;

    protected function setUp(): void
    {
        $this->realGitParser = new GitParser(
            new GitProcess(__DIR__ . '/../../'),
            new GitCommandFactory(),
        );
    }

    public function testShouldReadARealGitInfoAboutThisLibrary(): void
    {
        $config = new Config(
            new GitConfig([
                'commit' => 'GIT_COMMIT',
                'branch' => 'GIT_BRANCH',
                'url' => 'GIT_URL',
                'tag' => 'GIT_TAG',
            ]),
            null,
        );

        $variables = $this->realGitParser
            ->parseGitValues($config)
            ->toArray();

        // check git commit
        $this->assertArrayHasKey('GIT_COMMIT', $variables);
        $this->assertSame(40, mb_strlen($variables['GIT_COMMIT']));

        // check git branch
        $this->assertArrayHasKey('GIT_BRANCH', $variables);
        if ($variables['GIT_BRANCH'] !== 'master') {
            $this->assertStringStartsWith('feature', $variables['GIT_BRANCH']);
        } else {
            $this->assertSame('master', $variables['GIT_BRANCH']);
        }

        // check git url
        $this->assertArrayHasKey('GIT_URL', $variables);
        $this->assertSame('git@github.com:MortalFlesh/pre-build.git', $variables['GIT_URL']);

        // check git tag
        $this->assertArrayHasKey('GIT_TAG', $variables);
        $this->assertMatchesRegularExpression('/\d+\.\d+\.\d+/', $variables['GIT_TAG']);
    }
}
