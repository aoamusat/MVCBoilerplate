<?php

namespace App\Core\Console;

use App\Core\Console\Commands\RunCommand;

class Console
{
    private $commands = [];

    public function __construct()
    {
        $this->registerCommands();
    }

    private function registerCommands()
    {
        $this->commands['run'] = new RunCommand();
    }

    public function run(array $argv)
    {
        if (count($argv) < 2) {
            $this->showHelp();
            return;
        }

        $command = $argv[1];

        if (!isset($this->commands[$command])) {
            $this->output("Command '{$command}' not found.\n");
            $this->showHelp();
            return;
        }

        $this->commands[$command]->execute(array_slice($argv, 2));
    }

    private function showHelp()
    {
        $this->output("Fortress CLI\n");
        $this->output("Usage: php fortress <command> [arguments]\n\n");
        $this->output("Available commands:\n");
        $this->output("  run        Start the development server\n");
    }

    private function output($message)
    {
        echo $message;
    }
}