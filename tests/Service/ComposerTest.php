<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use PHPUnit\Framework\TestCase;
use function safe\file_get_contents;

class ComposerTest extends TestCase
{
    public function testShouldFindVersionInComposerJson(): void
    {
        $composer = json_decode(file_get_contents(__DIR__ . '/../../composer.json'), true);

        $this->assertArrayHasKey(
            'version',
            $composer,
            'Since the version is used inside application and the console, it must remain here.',
        );
    }
}
