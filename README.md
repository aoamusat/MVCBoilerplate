# Fortress

A secure, enterprise-grade MVC framework in PHP with built-in security features, middleware pipeline, and advanced dependency injection. Perfect for teaching modern PHP development patterns and building production-ready micro PHP applications.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes.

## Features

- **🔒 Built-in Security**: SQL injection protection, input sanitization, and secure query building
- **🛡️ Middleware Pipeline**: Rate limiting, request throttling, and extensible middleware system
- **🏗️ Advanced DI Container**: Interface binding, auto-resolution, and singleton management
- **⚡ Performance**: Optimized routing with middleware caching and efficient request handling
- **🎯 Clean Architecture**: Separation of concerns with proper exception handling
- **🛠️ CLI Tools**: Laravel Artisan-like command line interface for development
- **📚 Educational**: Perfect for learning modern PHP development patterns

### Prerequisites

1. Composer PHP package manager [https://getcomposer.org]
2. PHP 7.4 or higher
3. MySQL/MariaDB database

### Installation

1)Install Composer PHP package manager [https://getcomposer.org]

2) Clone this Repository in CLI by running:

```bash
git clone https://github.com/aoamusat/fortress.git
```

3) Navigate to the project directory:

```bash
cd fortress
```

4) Install dependencies:

```bash
composer install
```

5) Configure your database in `config.php`:

```php
'database' => [
    'name' => 'your_database_name',
    'host' => 'localhost',
    'username' => 'your_username',
    'password' => 'your_password',
]
```

6) Start the development server:
```bash
php fortress run
```

Or visit via traditional web server:
```
http://localhost/fortress
```

## Architecture

fortress follows a clean MVC architecture with additional security layers:

```
app/
├── controllers/        # Request handlers
├── core/              # Framework core
│   ├── console/       # CLI command system
│   ├── exceptions/    # Custom exception classes
│   ├── interfaces/    # Contracts and interfaces
│   ├── middleware/    # Security and request middleware
│   └── database/      # Database layer with security
├── views/             # Presentation layer
└── bootstrap/         # Application bootstrap files
```

## Security Features

### 🔒 SQL Injection Protection
- Parameterized queries with PDO
- Input sanitization and validation
- Secure database connection handling

### 🛡️ Rate Limiting & Throttling
```php
// Configure in routes.php
$router->middleware(new RateLimitMiddleware(100, 60))  // 100 requests/minute
       ->middleware(new ThrottleMiddleware(1));         // 1 second between requests
```

### 🏗️ Dependency Injection
```php
// Interface binding
App::bind(UserRepositoryInterface::class, UserRepository::class);

// Singleton registration
App::singleton(DatabaseManager::class);

// Auto-resolution
$service = App::resolve(SomeService::class);
```

## CLI Commands

Fortress includes a Laravel Artisan-like CLI system for development tasks:

### Development Server
```bash
# Start server (default: localhost:8000)
php fortress run

# Custom host and port
php fortress run 127.0.0.1:3000
php fortress run --host=0.0.0.0 --port=8080

# Show help
php fortress run --help
```

### Available Commands
- `run` - Start the development server with built-in PHP server

### Extending the CLI
Create new commands by implementing `CommandInterface`:

```php
<?php
namespace App\Core\Console\Commands;

class MyCommand implements CommandInterface
{
    public function execute(array $arguments)
    {
        // Your command logic here
    }
}
```

Register commands in `app/Core/Console/Console.php`.


## Contributing

Please read [CONTRIBUTING.md](https://github.com/aoamusat/fortress/blob/master/CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Changelog

### v2.1.0 (Latest)
- ✅ Added Laravel Artisan-like CLI system
- ✅ Implemented development server command
- ✅ Enhanced developer experience with command-line tools

### v2.0.0
- ✅ Fixed critical SQL injection vulnerabilities
- ✅ Added comprehensive exception handling system
- ✅ Implemented advanced dependency injection container
- ✅ Built middleware pipeline with rate limiting
- ✅ Added request throttling capabilities
- ✅ Enhanced security throughout the framework

### v1.0.0 (Original)
- Basic MVC structure
- Simple routing system
- Basic database connection

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
