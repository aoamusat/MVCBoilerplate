<?php

namespace App\Core\Console\Commands;

interface CommandInterface
{
    public function execute(array $arguments);
}