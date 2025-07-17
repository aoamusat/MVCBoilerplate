<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Core\Container;
use App\Core\Exceptions\ServiceNotFoundException;

class ContainerTest extends TestCase
{
    private Container $container;

    protected function setUp(): void
    {
        $this->container = Container::getInstance();
        
        // Clear any existing bindings for clean tests
        $reflection = new \ReflectionClass($this->container);
        $bindingsProperty = $reflection->getProperty('bindings');
        $bindingsProperty->setAccessible(true);
        $bindingsProperty->setValue($this->container, []);
        
        $singletonsProperty = $reflection->getProperty('singletons');
        $singletonsProperty->setAccessible(true);
        $singletonsProperty->setValue($this->container, []);
        
        $resolvedProperty = $reflection->getProperty('resolved');
        $resolvedProperty->setAccessible(true);
        $resolvedProperty->setValue($this->container, []);
    }

    public function testGetInstanceReturnsSameInstance(): void
    {
        $container1 = Container::getInstance();
        $container2 = Container::getInstance();
        
        $this->assertSame($container1, $container2);
    }

    public function testBindAndResolveService(): void
    {
        $this->container->bind('test.service', TestService::class);
        
        $service = $this->container->resolve('test.service');
        
        $this->assertInstanceOf(TestService::class, $service);
    }

    public function testBindWithClosure(): void
    {
        $this->container->bind('test.closure', function() {
            return new TestService();
        });
        
        $service = $this->container->resolve('test.closure');
        
        $this->assertInstanceOf(TestService::class, $service);
    }

    public function testSingletonBinding(): void
    {
        $this->container->singleton('test.singleton', TestService::class);
        
        $service1 = $this->container->resolve('test.singleton');
        $service2 = $this->container->resolve('test.singleton');
        
        $this->assertSame($service1, $service2);
    }

    public function testRegularBindingCreatesNewInstances(): void
    {
        $this->container->bind('test.service', TestService::class);
        
        $service1 = $this->container->resolve('test.service');
        $service2 = $this->container->resolve('test.service');
        
        $this->assertNotSame($service1, $service2);
        $this->assertInstanceOf(TestService::class, $service1);
        $this->assertInstanceOf(TestService::class, $service2);
    }

    public function testHasMethod(): void
    {
        $this->container->bind('test.service', TestService::class);
        
        $this->assertTrue($this->container->has('test.service'));
        $this->assertFalse($this->container->has('non.existent.service'));
    }

    public function testHasMethodWithExistingClass(): void
    {
        $this->assertTrue($this->container->has(TestService::class));
        $this->assertFalse($this->container->has('NonExistentClass'));
    }

    public function testGetMethod(): void
    {
        $this->container->bind('test.service', TestService::class);
        
        $service = $this->container->get('test.service');
        
        $this->assertInstanceOf(TestService::class, $service);
    }

    public function testAutoResolutionWithoutBinding(): void
    {
        $service = $this->container->resolve(TestService::class);
        
        $this->assertInstanceOf(TestService::class, $service);
    }

    public function testDependencyInjection(): void
    {
        $this->container->bind(TestDependency::class, TestDependency::class);
        
        $service = $this->container->resolve(TestServiceWithDependency::class);
        
        $this->assertInstanceOf(TestServiceWithDependency::class, $service);
        $this->assertInstanceOf(TestDependency::class, $service->getDependency());
    }

    public function testThrowsExceptionForNonExistentService(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        
        $this->container->resolve('NonExistentClass');
    }

    public function testThrowsExceptionForNonInstantiableClass(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage('Class Tests\Unit\TestAbstractClass is not instantiable');
        
        $this->container->resolve(TestAbstractClass::class);
    }

    public function testResolvesDefaultParameterValues(): void
    {
        $service = $this->container->resolve(TestServiceWithDefaultValue::class);
        
        $this->assertInstanceOf(TestServiceWithDefaultValue::class, $service);
        $this->assertEquals('default', $service->getValue());
    }

    public function testThrowsExceptionForUnresolvableParameter(): void
    {
        $this->expectException(ServiceNotFoundException::class);
        $this->expectExceptionMessage('Cannot resolve dependency');
        
        $this->container->resolve(TestServiceWithUnresolvableParameter::class);
    }
}

// Test classes
class TestService
{
    public function getValue(): string
    {
        return 'test';
    }
}

class TestDependency
{
    public function getName(): string
    {
        return 'dependency';
    }
}

class TestServiceWithDependency
{
    private TestDependency $dependency;

    public function __construct(TestDependency $dependency)
    {
        $this->dependency = $dependency;
    }

    public function getDependency(): TestDependency
    {
        return $this->dependency;
    }
}

abstract class TestAbstractClass
{
    abstract public function test(): void;
}

class TestServiceWithDefaultValue
{
    private string $value;

    public function __construct(string $value = 'default')
    {
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}

class TestServiceWithUnresolvableParameter
{
    public function __construct(string $requiredParameter)
    {
        // This will fail because string cannot be auto-resolved
    }
}