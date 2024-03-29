<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Fixtures\Git\GitCommand;
use MF\PreBuild\Git\GitCommandFactory;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class GitParserTest extends TestCase
{
    private GitParser $gitParser;
    /** @var GitCommandFactory|m\MockInterface */
    private GitCommandFactory $gitCommandFactory;

    protected function setUp(): void
    {
        $this->gitCommandFactory = m::mock(GitCommandFactory::class);

        $this->gitParser = new GitParser(
            new GitProcess(__DIR__ . '/../../'),
            $this->gitCommandFactory,
        );
    }

    public function testShouldParseGitValuesByConfig(): void
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
        $expectedVariables = [
            'GIT_COMMIT' => 'VALUE-commit',
            'GIT_BRANCH' => 'VALUE-branch',
            'GIT_URL' => 'VALUE-url',
            'GIT_TAG' => 'VALUE-tag',
        ];

        $this->gitCommandFactory->expects('createGitCommand')
            ->times(4)
            ->andReturn(
                new GitCommand('VALUE-commit'),
                new GitCommand('VALUE-branch'),
                new GitCommand('VALUE-url'),
                new GitCommand('VALUE-tag'),
            );

        $variables = $this->gitParser->parseGitValues($config);

        $this->assertEquals($expectedVariables, $variables->toArray());
    }
}
