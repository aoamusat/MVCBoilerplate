<?php

namespace App\Core\Console\Commands;

class RunCommand implements CommandInterface
{
    public function execute(array $arguments)
    {
        $host = 'localhost';
        $port = '8000';
        
        foreach ($arguments as $arg) {
            if ($arg === '--help' || $arg === '-h') {
                $this->showHelp();
                return;
            } elseif (strpos($arg, '--host=') === 0) {
                $host = substr($arg, 7);
            } elseif (strpos($arg, '--port=') === 0) {
                $port = substr($arg, 7);
            } elseif (strpos($arg, '-') !== 0) {
                if (strpos($arg, ':') !== false) {
                    list($host, $port) = explode(':', $arg, 2);
                } else {
                    $host = $arg;
                }
            }
        }
        
        $this->output("Starting Fortress development server...\n");
        $this->output("Server running at http://{$host}:{$port}\n");
        $this->output("Press Ctrl+C to stop the server\n\n");
        
        $documentRoot = realpath(__DIR__ . '/../../../../');
        $routerScript = realpath(__DIR__ . '/../../../../index.php');
        
        $command = "php -S {$host}:{$port} -t {$documentRoot} {$routerScript}";
        
        passthru($command);
    }
    
    private function showHelp()
    {
        $this->output("Usage: php fortress run [host:port] [options]\n\n");
        $this->output("Start the Fortress development server\n\n");
        $this->output("Arguments:\n");
        $this->output("  host:port    Server host and port (default: localhost:8000)\n\n");
        $this->output("Options:\n");
        $this->output("  --host=HOST  Server host (default: localhost)\n");
        $this->output("  --port=PORT  Server port (default: 8000)\n");
        $this->output("  -h, --help   Show this help message\n");
    }
    
    private function output($message)
    {
        echo $message;
    }
}