# Fortress Test Suite

This directory contains comprehensive unit tests for the Fortress PHP framework, ensuring security, reliability, and maintainability.

## Test Structure

```
tests/
├── Unit/                    # Unit tests for individual components
│   ├── ContainerTest.php   # Dependency injection container tests
│   ├── RouterTest.php      # Routing system tests
│   ├── QueryBuilderTest.php # Database query builder tests
│   ├── QueryBuilderSecurityTest.php # Security-focused database tests
│   ├── MiddlewareTest.php  # Middleware system tests
│   └── ExceptionTest.php   # Custom exception tests
├── Integration/            # Integration tests (future)
├── Feature/               # Feature tests (future)
├── bootstrap.php          # Test bootstrap file
└── README.md             # This file
```

## Test Coverage

### ✅ Container Tests (`ContainerTest.php`)
- **Singleton pattern** - Ensures container returns same instance
- **Service binding** - Tests binding services to the container
- **Dependency injection** - Verifies automatic dependency resolution
- **Closure binding** - Tests binding closures as services
- **Singleton services** - Ensures singletons return same instance
- **Auto-resolution** - Tests automatic class instantiation
- **Exception handling** - Verifies proper error handling

### ✅ Router Tests (`RouterTest.php`)
- **Route registration** - Tests all HTTP methods (GET, POST, PUT, DELETE, PATCH, HEAD)
- **Route dispatch** - Verifies correct controller/method calling
- **Middleware integration** - Tests middleware pipeline execution
- **Exception handling** - Tests RouteNotFoundException and MethodNotFoundException
- **Static loading** - Tests loading routes from files

### ✅ QueryBuilder Security Tests (`QueryBuilderSecurityTest.php`)
- **SQL injection prevention** - Ensures parameterized queries are used
- **Parameter binding** - Verifies correct parameter types and binding
- **Input sanitization** - Tests handling of malicious input
- **Error handling** - Tests PDO exception handling
- **Data validation** - Ensures proper data type handling

### ✅ QueryBuilder Tests (`QueryBuilderTest.php`)
- **Database operations** - Tests selectAll, findOne, insert methods
- **Return types** - Verifies correct return types for all methods
- **Table name escaping** - Tests proper table name escaping
- **Empty data handling** - Tests behavior with empty datasets
- **Special characters** - Tests handling of special characters in data

### ✅ Middleware Tests (`MiddlewareTest.php`)
- **Rate limiting** - Tests request rate limiting functionality
- **Request throttling** - Tests minimum interval between requests
- **Pipeline execution** - Tests middleware execution order
- **Request modification** - Tests middleware ability to modify requests
- **Short-circuiting** - Tests middleware ability to stop pipeline
- **HTTP headers** - Tests proper HTTP header setting

### ✅ Exception Tests (`ExceptionTest.php`)
- **Custom exceptions** - Tests all custom exception classes
- **HTTP status codes** - Verifies correct HTTP status codes
- **Error messages** - Tests proper error message formatting
- **Exception inheritance** - Tests proper exception hierarchy
- **Serialization** - Tests toArray() method for API responses

## Running Tests

### Prerequisites
```bash
composer install
```

### Run All Tests
```bash
composer test
# or
vendor/bin/phpunit
```

### Run Specific Test Suite
```bash
vendor/bin/phpunit tests/Unit/ContainerTest.php
vendor/bin/phpunit tests/Unit/RouterTest.php
vendor/bin/phpunit tests/Unit/QueryBuilderSecurityTest.php
```

### Run Tests with Coverage
```bash
composer test:coverage
# or
vendor/bin/phpunit --coverage-html coverage
```

### Run Tests by Group
```bash
vendor/bin/phpunit --group security
vendor/bin/phpunit --group middleware
```

## Test Configuration

### PHPUnit Configuration (`phpunit.xml`)
- **Bootstrap**: `vendor/autoload.php`
- **Test directories**: `tests/`
- **Coverage**: Includes `app/` directory, excludes `app/views/` and `app/bootstrap/`
- **Environment**: Sets `APP_ENV=testing`

### Test Bootstrap (`tests/bootstrap.php`)
- **Autoloading**: Includes Composer autoloader
- **Environment setup**: Configures test environment
- **Function mocking**: Provides mock implementations for global functions

## Security Testing

Our test suite includes comprehensive security testing:

### SQL Injection Prevention
- Tests parameterized queries
- Verifies malicious input handling
- Ensures proper parameter binding

### Input Validation
- Tests special character handling
- Verifies data sanitization
- Ensures proper error responses

### Rate Limiting
- Tests request throttling
- Verifies rate limit enforcement
- Ensures proper HTTP responses

## Mock Objects

Tests use PHPUnit mock objects for:
- **PDO database connections**
- **PDO statements**
- **HTTP requests**
- **Middleware components**

## Test Quality Standards

- **Code Coverage**: Aim for >90% coverage
- **Test Isolation**: Each test is independent
- **Descriptive Names**: Test methods clearly describe what they test
- **Comprehensive Assertions**: Multiple assertions per test when appropriate
- **Error Cases**: Tests include both success and failure scenarios

## Adding New Tests

### For New Features:
1. Create test file in appropriate directory
2. Follow existing naming conventions
3. Include both positive and negative test cases
4. Add security tests for any user input handling
5. Update this README with new test descriptions

### Test Structure:
```php
<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class YourFeatureTest extends TestCase
{
    protected function setUp(): void
    {
        // Set up test environment
    }

    public function testYourFeature(): void
    {
        // Arrange
        // Act
        // Assert
    }
}
```

## Continuous Integration

These tests are designed to run in CI/CD environments:
- **No external dependencies** (uses mocks)
- **Fast execution** (unit tests only)
- **Comprehensive coverage**
- **Clear failure reporting**

## Performance

- **Test execution time**: < 5 seconds for full suite
- **Memory usage**: Minimal due to mocking
- **Parallel execution**: Compatible with PHPUnit parallel testing

---

**Note**: This test suite focuses on unit testing. Integration and feature tests will be added in future releases.