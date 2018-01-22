<?php

namespace MF\PreBuild\Tests;

use MF\PreBuild\Entity\Variables;
use MF\PreBuild\Service\VariablesExporter;
use PHPUnit\Framework\TestCase;

/**
 * @group unit
 */
class VariablesExporterTest extends TestCase
{
    /** @var VariablesExporter */
    private $variablesExporter;

    public function setUp()
    {
        $this->variablesExporter = new VariablesExporter();
    }

    public function testShouldExportFlattenVariables()
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