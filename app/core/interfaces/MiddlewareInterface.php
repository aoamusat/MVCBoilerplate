<?php

namespace App\Core\Interfaces;

interface MiddlewareInterface
{
    public function handle(Request $request, \Closure $next);
}