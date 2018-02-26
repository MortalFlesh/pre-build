<?php

namespace MF\PreBuild\Tests\Service;

use GitWrapper\GitWrapper;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\GitConfig;
use MF\PreBuild\Entity\Md5SumConfig;
use MF\PreBuild\Git\GitCommandFactory;
use MF\PreBuild\Service\GitParser;
use MF\PreBuild\Tests\Fixtures\Git\GitCommand;
use Mockery as m;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class GitParserTest extends TestCase
{
    /** @var GitParser */
    private $gitParser;

    /** @var GitCommandFactory|m\MockInterface */
    private $gitCommandFactory;

    public function setUp()
    {
        $this->gitCommandFactory = m::mock(GitCommandFactory::class);

        $this->gitParser = new GitParser(
            new GitWrapper(),
            $this->gitCommandFactory
        );
    }

    public function testShouldParseGitValuesByConfig()
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
