<?php

namespace MF\PreBuild\Facade;

use MF\PreBuild\Entity\Config;

class ConfigReader
{
    public function readConfig(string $configPath): Config
    {
        throw new \Exception(sprintf('Method %s is not implemented yet.', __METHOD__));
    }
}
