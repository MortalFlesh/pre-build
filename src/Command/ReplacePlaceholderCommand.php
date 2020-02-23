<?php declare(strict_types=1);

namespace MF\PreBuild\Command;

use MF\PreBuild\Facade\ReplacePlaceholderFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ReplacePlaceholderCommand extends AbstractCommand
{
    /** @var ReplacePlaceholderFacade */
    private $replacePlaceholderFacade;

    public function __construct(array $composer, ReplacePlaceholderFacade $replacePlaceholderFacade)
    {
        parent::__construct($composer);

        $this->replacePlaceholderFacade = $replacePlaceholderFacade;
    }

    protected function configure(): void
    {
        $this
            ->setName('replace-placeholder')
            ->setDescription('Replaces placeholder in given file')
            ->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Path to config', './.pre-build.yml');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $configPath = $input->getOption('config');

            $this->replacePlaceholderFacade->replacePlaceholders($configPath);

            $this->io->success('Done');

            return 0;
        } catch (\Throwable $e) {
            $this->io->error($e->getMessage());

            return 1;
        }
    }
}
