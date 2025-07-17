<?php

namespace App\Core;

use App\Core\Interfaces\MiddlewareInterface;

class MiddlewarePipeline
{
    private $middlewares = [];

    public function add(MiddlewareInterface $middleware): self
    {
        $this->middlewares[] = $middleware;
        return $this;
    }

    public function handle(Request $request, \Closure $destination)
    {
        $pipeline = array_reduce(
            array_reverse($this->middlewares),
            function ($next, $middleware) {
                return function ($request) use ($next, $middleware) {
                    return $middleware->handle($request, $next);
                };
            },
            $destination
        );

        return $pipeline($request);
    }
}