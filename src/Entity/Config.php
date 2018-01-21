<?php

namespace MF\PreBuild\Entity;

class Config
{
    /** @var GitConfig */
    private $gitConfig;

    public function __construct(GitConfig $gitConfig)
    {
        $this->gitConfig = $gitConfig;
    }

    public function getGitConfig(): GitConfig
    {
        return $this->gitConfig;
    }
}
