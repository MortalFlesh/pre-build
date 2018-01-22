<?php

namespace MF\PreBuild\Command;

use Assert\Assertion;
use MF\PreBuild\Facade\ParseVariablesFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ParseVariablesCommand extends AbstractCommand
{
    /** @var ParseVariablesFacade */
    private $parseVariablesFacade;

    public function __construct(array $composer, ParseVariablesFacade $parseVariablesFacade)
    {
        parent::__construct($composer);

        $this->parseVariablesFacade = $parseVariablesFacade;
    }

    protected function configure()
    {
        $this
            ->setName('parse-variables')
            ->setDescription('Parse variables by given config file')
            ->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Path to config', './.pre-build.yml')
            ->addOption('output', 'o', InputOption::VALUE_OPTIONAL, 'Output format [std, visual]', 'std');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $configPath = $input->getOption('config');
            $output = $input->getOption('output');

            Assertion::inArray($output, ['std', 'visual']);
            $isStdOutput = $output === 'std';

            $variables = $this->parseVariablesFacade->parseVariables($configPath);

            if ($isStdOutput) {
                foreach ($variables as $key => $value) {
                    $this->io->writeln(sprintf('%s=%s', $key, $value));
                }
            } else {
                $this->title();

                $this->io->table(
                    ['key', 'value'],
                    $variables
                        ->map('($k, $v) => [$k, $v]', 'array')
                        ->values()
                        ->toArray()
                );

                $this->io->success('Done');
            }

            return 0;
        } catch (\Exception $e) {
            $this->io->error($e->getMessage());

            return 1;
        }
    }
}
