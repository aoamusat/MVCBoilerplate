<?php

use App\Core\Middleware\RateLimitMiddleware;
use App\Core\Middleware\ThrottleMiddleware;

return [
    // Rate limit: 100 requests per minute
    'rate_limit' => new RateLimitMiddleware(100, 60),
    
    // Throttle: minimum 1 second between requests
    'throttle' => new ThrottleMiddleware(1),
];