<?php

namespace App\Core\Interfaces;

interface MiddlewareInterface
{
    public function handle(\App\Core\Request $request, \Closure $next);
}