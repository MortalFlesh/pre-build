<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use MF\Collection\Mutable\Generic\ListCollection;
use MF\PreBuild\Entity\Variables;

class VariablesExporter
{
    /** @phpstan-var ListCollection<Variables> */
    private ListCollection $variables;

    public function __construct()
    {
        $this->variables = new ListCollection();
    }

    public function addSource(Variables $variables): self
    {
        $this->variables->add($variables);

        return $this;
    }

    public function export(): Variables
    {
        return $this->variables
            ->reduce(
                function (Variables $all, Variables $current) {
                    foreach ($current as $key => $value) {
                        $all->set($key, $value);
                    }

                    return $all;
                },
                new Variables(),
            );
    }
}
