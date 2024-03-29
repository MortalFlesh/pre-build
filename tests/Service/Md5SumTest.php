<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\AbstractTestCase;
use MF\PreBuild\Entity\Config;
use MF\PreBuild\Entity\Md5SumConfig;

/**
 * @group unit
 */
class Md5SumTest extends AbstractTestCase
{
    private Md5Sum $md5sum;

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
            ]),
        );

        $variables = $this->md5sum->findMd5Sum($config);

        $this->assertSame('6158e1ebc3616886d69778164fc39574', $variables->get('CSSVER'));
        $this->assertSame('8d3a465fe1c15cafc1b6c9e2edac5c6a', $variables->get('JSVER'));
    }
}
