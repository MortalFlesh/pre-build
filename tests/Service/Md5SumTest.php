<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\AbstractTestCase;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Md5SumConfig;
use MF\PreBuild\Entity\Md5SumReplaceConfig;
use MF\PreBuild\Entity\ReplacePlaceholder;

/**
 * @group unit
 */
class Md5SumTest extends AbstractTestCase
{
    private const MD5_CSS = '6158e1ebc3616886d69778164fc39574';
    private const MD5_JS = '8d3a465fe1c15cafc1b6c9e2edac5c6a';

    /** @var Md5Sum */
    private $md5sum;

    protected function setUp(): void
    {
        $this->md5sum = new Md5Sum();
    }

    public function testShouldFindMd5SumOfGivenFiles(): void
    {
        $config = new Config(
            null,
            new Md5SumConfig([
                __DIR__ . '/../Fixtures/Md5/style.css' => 'CSSVER',
                __DIR__ . '/../Fixtures/Md5/index.js' => 'JSVER',
            ])
        );

        $variables = $this->md5sum->findMd5SumToVariables($config);

        $this->assertSame(self::MD5_CSS, $variables->get('CSSVER'));
        $this->assertSame(self::MD5_JS, $variables->get('JSVER'));
    }

    public function testShouldFindMd5SumOfGivenFilesForReplacingPlaceholders(): void
    {
        $parametersFile = __DIR__ . '/../Fixtures/Replace/parameters.yml';

        $config = new Config(
            null,
            null,
            new Md5SumReplaceConfig([
                __DIR__ . '/../Fixtures/Md5/style.css' => [$parametersFile, '___CSSVER___'],
                __DIR__ . '/../Fixtures/Md5/index.js' => [$parametersFile, '___JSVER___'],
            ])
        );
        $expected = [
            new ReplacePlaceholder($parametersFile, '___CSSVER___', self::MD5_CSS),
            new ReplacePlaceholder($parametersFile, '___JSVER___', self::MD5_JS),
        ];

        $replacements = $this->md5sum->findMd5SumForReplace($config);

        $this->assertEquals($expected, $replacements->toArray());
    }
}
