<?php

namespace App\Core\Interfaces;

interface ContainerInterface
{
    public function bind(string $abstract, $concrete = null): void;
    public function singleton(string $abstract, $concrete = null): void;
    public function get(string $abstract);
    public function has(string $abstract): bool;
    public function resolve(string $abstract);
}