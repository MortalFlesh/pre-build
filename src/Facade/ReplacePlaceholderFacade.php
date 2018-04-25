<?php declare(strict_types=1);

namespace MF\PreBuild\Facade;

use MF\PreBuild\Service\ConfigReader;
use MF\PreBuild\Service\Md5Sum;

class ReplacePlaceholderFacade
{
    /** @var ConfigReader */
    private $configReader;

    /** @var Md5Sum */
    private $md5Sum;

    public function __construct(ConfigReader $configReader, Md5Sum $md5Sum)
    {
        $this->configReader = $configReader;
        $this->md5Sum = $md5Sum;
    }

    public function replacePlaceholders(string $configPath): void
    {
        $config = $this->configReader->readConfig($configPath);

        $replacements = $this->md5Sum->findMd5SumForReplace($config);

        //dump($replacements->toArray());
        // todo - $this->replaceService->replace($replacements);
    }
}
