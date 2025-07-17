<?php

namespace App\Core;

use App\Core\Interfaces\ContainerInterface;
use App\Core\Exceptions\ServiceNotFoundException;
use ReflectionClass;
use ReflectionException;

class Container implements ContainerInterface
{
    private static $instance = null;
    private $bindings = [];
    private $singletons = [];
    private $resolved = [];

    private function __construct() {}

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function bind(string $abstract, $concrete = null): void
    {
        $this->bindings[$abstract] = $concrete ?? $abstract;
    }

    public function singleton(string $abstract, $concrete = null): void
    {
        $this->singletons[$abstract] = $concrete ?? $abstract;
    }

    public function get(string $abstract)
    {
        return $this->resolve($abstract);
    }

    public function has(string $abstract): bool
    {
        return isset($this->bindings[$abstract]) || 
               isset($this->singletons[$abstract]) || 
               class_exists($abstract);
    }

    public function resolve(string $abstract)
    {
        if (isset($this->resolved[$abstract]) && isset($this->singletons[$abstract])) {
            return $this->resolved[$abstract];
        }

        $concrete = $this->getConcrete($abstract);
        $instance = $this->build($concrete);

        if (isset($this->singletons[$abstract])) {
            $this->resolved[$abstract] = $instance;
        }

        return $instance;
    }

    private function getConcrete(string $abstract)
    {
        if (isset($this->bindings[$abstract])) {
            return $this->bindings[$abstract];
        }

        if (isset($this->singletons[$abstract])) {
            return $this->singletons[$abstract];
        }

        return $abstract;
    }

    private function build($concrete)
    {
        if ($concrete instanceof \Closure) {
            return $concrete($this);
        }

        try {
            $reflection = new ReflectionClass($concrete);
        } catch (ReflectionException $e) {
            throw new ServiceNotFoundException($concrete);
        }

        if (!$reflection->isInstantiable()) {
            throw new ServiceNotFoundException("Class {$concrete} is not instantiable");
        }

        $constructor = $reflection->getConstructor();

        if (is_null($constructor)) {
            return new $concrete;
        }

        $parameters = $constructor->getParameters();
        $dependencies = $this->resolveDependencies($parameters);

        return $reflection->newInstanceArgs($dependencies);
    }

    private function resolveDependencies(array $parameters): array
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {
            $dependency = $parameter->getClass();

            if ($dependency === null) {
                if ($parameter->isDefaultValueAvailable()) {
                    $dependencies[] = $parameter->getDefaultValue();
                } else {
                    throw new ServiceNotFoundException("Cannot resolve dependency {$parameter->name}");
                }
            } else {
                $dependencies[] = $this->resolve($dependency->name);
            }
        }

        return $dependencies;
    }
}