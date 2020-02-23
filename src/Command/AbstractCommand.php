<?php declare(strict_types=1);

namespace MF\PreBuild\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

abstract class AbstractCommand extends Command
{
    const COMMAND_PREFIX = 'pre-build:';

    /** @var array */
    private $composer;

    /** @var SymfonyStyle */
    protected $io;

    public function __construct(array $composer)
    {
        parent::__construct();

        $this->composer = $composer;
    }

    protected function initialize(InputInterface $input, OutputInterface $output): void
    {
        $this->io = new SymfonyStyle($input, $output);

        if (!$this->io->isVerbose()) {
            ini_set('display_errors', '0');
            ini_set('error_reporting', '0');
        }
    }

    protected function title(): void
    {
        ['version' => $version] = $this->composer;

        $this->io->title(
            sprintf(
                '<fg=cyan>MF/Pre build</> [<fg=magenta>%s</>] will prepare everything for you <fg=red>:)</>',
                $version
            )
        );
        $this->io->section($this->getName());
    }

    public function setName($name)
    {
        return parent::setName(self::COMMAND_PREFIX . $name);
    }
}
