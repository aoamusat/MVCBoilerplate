# Contributing to Fortress

Thank you for considering contributing to Fortress! This document outlines the guidelines and processes for contributing to our secure, enterprise-grade MVC framework.

## Table of Contents

- [Code of Conduct](#code-of-conduct)
- [Getting Started](#getting-started)
- [Development Setup](#development-setup)
- [Contributing Guidelines](#contributing-guidelines)
- [Security Contributions](#security-contributions)
- [Code Standards](#code-standards)
- [Testing](#testing)
- [Pull Request Process](#pull-request-process)
- [Issue Reporting](#issue-reporting)

## Code of Conduct

By participating in this project, you agree to abide by our code of conduct:

- Be respectful and inclusive
- Focus on constructive feedback
- Help maintain a welcoming environment
- Report any unacceptable behavior to the maintainers

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL/MariaDB
- Git
- Basic understanding of MVC architecture
- Familiarity with security best practices

### Development Setup

1. Fork the repository
2. Clone your fork:
   ```bash
   git clone https://github.com/aoamusat/fortress.git
   cd fortress
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Create a feature branch:
   ```bash
   git checkout -b feature/your-feature-name
   ```

5. Set up your development environment:
   ```bash
   cp config.php.example config.php
   # Edit config.php with your database credentials
   ```

## Contributing Guidelines

### What We're Looking For

- **Security improvements** and vulnerability fixes
- **Performance optimizations** 
- **Documentation improvements**
- **Bug fixes** with test cases
- **New middleware** for common use cases
- **Educational examples** and tutorials

### What We Don't Accept

- Breaking changes without prior discussion
- Code that introduces security vulnerabilities
- Contributions without proper testing
- Changes that significantly increase complexity
- Code that doesn't follow our standards

## Security Contributions

Security is our top priority. When contributing security-related changes:

### Reporting Security Issues

- **DO NOT** open public issues for security vulnerabilities
- Email security issues to: aoamusat@gmail.com
- Include detailed steps to reproduce
- Provide impact assessment

### Security Code Requirements

- All database queries must use parameterized statements
- Input validation must be comprehensive
- Error messages must not leak sensitive information
- Authentication and authorization must be properly implemented

## Code Standards

### PHP Standards

- Follow PSR-4 autoloading standards
- Use PSR-12 coding style
- Include proper type hints
- Add comprehensive DocBlocks

### File Structure

```
app/
├── controllers/           # Request handlers
├── core/                 # Framework core
│   ├── exceptions/       # Custom exceptions
│   ├── interfaces/       # Contracts
│   ├── middleware/       # Middleware classes
│   └── database/         # Database layer
├── views/                # Templates
└── bootstrap/            # Bootstrap files
```

### Naming Conventions

- **Classes**: PascalCase (e.g., `UserController`, `DatabaseManager`)
- **Methods**: camelCase (e.g., `getUserData`, `validateInput`)
- **Variables**: camelCase (e.g., `$userName`, `$databaseConnection`)
- **Constants**: UPPER_SNAKE_CASE (e.g., `MAX_LOGIN_ATTEMPTS`)

### Code Examples

#### Controller Example
```php
<?php

namespace App\Controller;

use App\Core\Exceptions\ValidationException;

class UserController
{
    public function store(): void
    {
        try {
            $this->validateInput($_POST);
            // Process user creation
        } catch (ValidationException $e) {
            // Handle validation errors
        }
    }

    private function validateInput(array $data): void
    {
        // Validation logic
    }
}
```

#### Middleware Example
```php
<?php

namespace App\Core\Middleware;

use App\Core\Interfaces\MiddlewareInterface;
use App\Core\Request;

class AuthMiddleware implements MiddlewareInterface
{
    public function handle(Request $request, \Closure $next)
    {
        // Authentication logic
        return $next($request);
    }
}
```

## Testing

### Test Requirements

- All new features must include tests
- Security-related changes require comprehensive test coverage
- Tests should cover both success and failure scenarios

### Running Tests

```bash
# Run all tests
composer test

# Run specific test suite
composer test -- --filter SecurityTest

# Run with coverage
composer test:coverage
```

### Test Structure

```php
<?php

use PHPUnit\Framework\TestCase;

class SecurityTest extends TestCase
{
    public function testSqlInjectionPrevention(): void
    {
        // Test that SQL injection is prevented
        $this->assertTrue($result);
    }

    public function testRateLimitingWorks(): void
    {
        // Test rate limiting functionality
        $this->assertThrows(RateLimitException::class, function() {
            // Rate limit test logic
        });
    }
}
```

## Pull Request Process

### Before Submitting

1. Ensure all tests pass
2. Update documentation if needed
3. Add changelog entry
4. Follow the PR template

### PR Template

```markdown
## Description
Brief description of changes

## Type of Change
- [ ] Bug fix
- [ ] New feature
- [ ] Security improvement
- [ ] Documentation update
- [ ] Performance improvement

## Testing
- [ ] Tests added/updated
- [ ] All tests pass
- [ ] Manual testing completed

## Security Checklist
- [ ] No sensitive data exposed
- [ ] Input validation implemented
- [ ] SQL injection prevention verified
- [ ] XSS prevention verified

## Breaking Changes
- [ ] No breaking changes
- [ ] Breaking changes documented
```

### Review Process

1. **Automated checks** must pass
2. **Security review** for security-related changes
3. **Code review** by maintainers
4. **Testing** in development environment
5. **Approval** by at least one maintainer

## Issue Reporting

### Bug Reports

Include:
- PHP version
- Fortress version
- Steps to reproduce
- Expected vs actual behavior
- Error messages/logs

### Feature Requests

Include:
- Use case description
- Proposed solution
- Alternative solutions considered
- Impact on existing functionality

### Security Issues

- Use private disclosure process
- Include proof of concept (if safe)
- Suggest mitigation strategies

## Development Workflow

### Branch Naming

- `feature/feature-name` - New features
- `bugfix/bug-description` - Bug fixes
- `security/security-fix` - Security improvements
- `docs/documentation-update` - Documentation

### Commit Messages

```
type(scope): description

feat(middleware): add JWT authentication middleware
fix(security): prevent SQL injection in QueryBuilder
docs(readme): update installation instructions
```

### Release Process

1. Create release branch
2. Update version numbers
3. Update changelog
4. Tag release
5. Merge to master

## Community

### Communication Channels

- GitHub Issues: Bug reports and feature requests
- GitHub Discussions: General questions and ideas
- Discord: Real-time community chat
- Email: aoamusat@gmail.com for security issues

### Recognition

Contributors will be recognized in:
- CHANGELOG.md
- README.md contributors section
- Release notes

## License

By contributing to Fortress, you agree that your contributions will be licensed under the MIT License.

---

Thank you for helping make Fortress a secure and robust framework for the PHP community!