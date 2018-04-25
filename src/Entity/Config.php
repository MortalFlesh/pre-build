<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class Config
{
    /** @var GitConfig|null */
    private $gitConfig;

    /** @var Md5SumConfig|null */
    private $md5SumConfig;

    public function __construct(?GitConfig $gitConfig, ?Md5SumConfig $md5SumConfig)
    {
        $this->gitConfig = $gitConfig;
        $this->md5SumConfig = $md5SumConfig;
    }

    public function getGitConfig(): ?GitConfig
    {
        return $this->gitConfig;
    }

    public function getMd5SumConfig(): ?Md5SumConfig
    {
        return $this->md5SumConfig;
    }
}
