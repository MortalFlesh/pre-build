<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class Config
{
    public function __construct(private ?GitConfig $gitConfig, private ?Md5SumConfig $md5SumConfig)
    {
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
