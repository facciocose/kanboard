<?php

namespace Kanboard\Console;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TaskClose extends Base
{
    protected function configure()
    {
        $this
            ->setName('close:tasks')
            ->setDescription('Close Tasks')
            ->addArgument('project_id', InputArgument::REQUIRED, 'Project id')
            ->addArgument('column_id', InputArgument::REQUIRED, 'Column id');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $tasks = $this->taskFinder->getTasksByColumnAndSwimlane($input->getArgument('project_id'), $input->getArgument('column_id'));
        foreach ($tasks as $task) {
            $this->taskStatus->close(intval($task["id"]));
        }
    }
}
