<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\PreBuild\Entity\Variables;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class VariablesExporterTest extends TestCase
{
    /** @var VariablesExporter */
    private $variablesExporter;

    protected function setUp(): void
    {
        $this->variablesExporter = new VariablesExporter();
    }

    public function testShouldExportFlattenVariables(): void
    {
        $first = new Variables();
        $first->set('first', 'f_value');
        $second = new Variables();
        $second->set('second', 's_value');

        $expected = [
            'first' => 'f_value',
            'second' => 's_value',
        ];

        $variables = $this->variablesExporter
            ->addSource($first)
            ->addSource($second)
            ->export();

        $this->assertEquals($expected, $variables->toArray());
    }
}
