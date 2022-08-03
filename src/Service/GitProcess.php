<?php declare(strict_types=1);

namespace MF\PreBuild\Service;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class GitProcess
{
    public function __construct(private readonly string $repositoryPath)
    {
    }

    public function git(string ...$args): string
    {
        $process = new Process(['git', ...$args], $this->repositoryPath);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}
