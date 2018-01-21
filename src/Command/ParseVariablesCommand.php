<?php

namespace MF\PreBuild\Command;

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
            ->addOption('config', 'c', InputOption::VALUE_REQUIRED, 'Path to config', './.pre-build.yml');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $configPath = $input->getOption('config');

            $this->parseVariablesFacade->parseVariables($configPath);
            $this->io->success('done');

            return 0;
        } catch (\Exception $e) {
            $this->io->error($e->getMessage());

            return 1;
        }
    }
}
