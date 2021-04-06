<?php declare(strict_types=1);

namespace MF\PreBuild\Command;

use Assert\Assertion;
use MF\PreBuild\Facade\ParseVariablesFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseVariablesCommand extends AbstractCommand
{
    public function __construct(array $composer, private ParseVariablesFacade $parseVariablesFacade)
    {
        parent::__construct($composer);
    }

    protected function configure(): void
    {
        $this
            ->setName('parse-variables')
            ->setDescription('Parse variables by given config file')
            ->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Path to config', './.pre-build.yml')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'Output format [std, visual]', 'std');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            $configPath = $input->getOption('config');
            Assertion::string($configPath);
            $outputPath = $input->getOption('output');
            Assertion::string($outputPath);

            Assertion::inArray($outputPath, ['std', 'visual']);
            $isStdOutput = $outputPath === 'std';

            $variables = $this->parseVariablesFacade->parseVariables($configPath);

            if ($isStdOutput) {
                foreach ($variables as $key => $value) {
                    $this->io->writeln(sprintf('export %s=%s', $key, $value));
                }
            } else {
                $this->title();

                $this->io->table(
                    ['key', 'value'],
                    $variables
                        ->map(fn ($k, $v) => [$k, $v], 'array')
                        ->values()
                        ->toArray()
                );

                $this->io->success('Done');
            }

            return 0;
        } catch (\Throwable $e) {
            $this->io->error($e->getMessage());

            return 1;
        }
    }
}
