<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use GitWrapper\GitWrapper;
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
            new GitWrapper(),
            $this->gitCommandFactory
        );
    }

    public function testShouldParseGitValuesByConfig(): void
    {
        $config = new Config(
            new GitConfig([
                'commit' => 'GIT_COMMIT',
                'branch' => 'GIT_BRANCH',
                'url' => 'GIT_URL',
            ]),
            null
        );
        $expectedVariables = [
            'GIT_COMMIT' => 'VALUE-commit',
            'GIT_BRANCH' => 'VALUE-branch',
            'GIT_URL' => 'VALUE-url',
        ];

        $this->gitCommandFactory->shouldReceive('createGitCommand')
            ->times(3)
            ->andReturn(
                new GitCommand('VALUE-commit'),
                new GitCommand('VALUE-branch'),
                new GitCommand('VALUE-url')
            );

        $variables = $this->gitParser->parseGitValues($config);

        $this->assertEquals($expectedVariables, $variables->toArray());
    }
}
