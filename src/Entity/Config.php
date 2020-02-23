<?php declare(strict_types=1);

namespace MF\PreBuild\Entity;

class Config
{
    /** @var GitConfig|null */
    private $gitConfig;

    /** @var Md5SumConfig|null */
    private $md5SumConfig;

    /** @var Md5SumReplaceConfig|null */
    private $md5SumReplaceConfig;

    public function __construct(
        ?GitConfig $gitConfig = null,
        ?Md5SumConfig $md5SumConfig = null,
        ?Md5SumReplaceConfig $md5SumReplaceConfig = null
    ) {
        $this->gitConfig = $gitConfig;
        $this->md5SumConfig = $md5SumConfig;
        $this->md5SumReplaceConfig = $md5SumReplaceConfig;
    }

    public function getGitConfig(): ?GitConfig
    {
        return $this->gitConfig;
    }

    public function getMd5SumConfig(): ?Md5SumConfig
    {
        return $this->md5SumConfig;
    }

    public function getMd5SumReplaceConfig(): ?Md5SumReplaceConfig
    {
        return $this->md5SumReplaceConfig;
    }
}
