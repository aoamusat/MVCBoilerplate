<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fortress - Secure Enterprise PHP Framework</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.7.2/css/fontawesome.min.css">
    <link href="https://cdn.lineicons.com/5.0/lineicons.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <?php include 'partials/nav.view.php'; ?>

    <!-- Hero Section -->
    <section class="bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-yellow-400 to-orange-500 bg-clip-text text-transparent">Fortress</span>
                </h1>
                <p class="text-xl md:text-2xl mb-8 text-blue-100 max-w-3xl mx-auto">
                    A secure, enterprise-grade MVC framework in PHP with built-in security features, middleware pipeline, and advanced dependency injection.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="https://github.com/aoamusat/fortress" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-200">
                        Get Started
                    </a>
                    <a href="#features" class="border border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition duration-200">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Enterprise Features</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Built for production with security, performance, and developer experience in mind.
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.4" d="M12.8608 2.29633C12.3094 2.06789 11.6899 2.06789 11.1385 2.29633L4.59034 5.00922C3.81392 5.33089 3.2534 6.07287 3.22752 6.95318C3.09402 11.4935 4.43153 17.7707 10.9353 21.5237C11.5955 21.9047 12.4101 21.9012 13.067 21.5139C19.4296 17.7631 20.8871 11.5013 20.7701 6.95597C20.7473 6.07313 20.1849 5.33068 19.409 5.00923L12.8608 2.29633ZM11.7126 3.68211C11.8964 3.60596 12.1029 3.60596 12.2867 3.68211L18.8349 6.39501C19.1038 6.50643 19.2642 6.74684 19.2706 6.99458C19.3795 11.223 18.0304 16.8467 12.3052 20.2218C12.1143 20.3343 11.8771 20.3354 11.685 20.2245C5.84237 16.853 4.60224 11.2358 4.72687 6.99727C4.73423 6.74708 4.89602 6.50622 5.16447 6.395L11.7126 3.68211Z" fill="#323544"/>
<path d="M15.5073 9.77545C15.8001 9.48255 15.8001 9.00768 15.5073 8.71479C15.2144 8.42189 14.7395 8.42189 14.4466 8.71479L10.9651 12.1963L9.55376 10.785C9.26087 10.4921 8.786 10.4921 8.4931 10.785C8.20021 11.0779 8.20022 11.5528 8.49311 11.8457L10.4347 13.7873C10.7276 14.0802 11.2025 14.0802 11.4954 13.7873L15.5073 9.77545Z" fill="#323544"/>
</svg>

                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Built-in Security</h3>
                    <p class="text-gray-600">SQL injection protection, input sanitization, and secure query building out of the box.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4 text-center fa-2x">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path opacity="0.4" d="M22 15.3438V11.662C21.5725 12.1973 21.0667 12.6673 20.5 13.0547V15.3438C20.5 15.758 20.1642 16.0938 19.75 16.0938H4.25C3.83579 16.0938 3.5 15.758 3.5 15.3438V6.75C3.5 6.33579 3.83579 6 4.25 6H9.88753C9.99391 5.47589 10.1599 4.97342 10.3782 4.5H4.25C3.00736 4.5 2 5.50736 2 6.75V15.3438C2 16.5864 3.00736 17.5938 4.25 17.5938H11.25V19.25H9.00003C8.58582 19.25 8.25003 19.5858 8.25003 20C8.25003 20.4142 8.58582 20.75 9.00003 20.75H15C15.4142 20.75 15.75 20.4142 15.75 20C15.75 19.5858 15.4142 19.25 15 19.25H12.75V17.5938H19.75C20.9926 17.5938 22 16.5864 22 15.3438Z" fill="#323544"/>
<path d="M15.0302 4.34255C15.3231 4.63535 15.3233 5.11022 15.0305 5.40321L13.0603 7.37465L15.0305 9.34624C15.3233 9.63924 15.3231 10.1141 15.0301 10.4069C14.7371 10.6997 14.2623 10.6995 13.9695 10.4065L11.4695 7.90478C11.1768 7.61192 11.1768 7.13732 11.4695 6.84448L13.9695 4.34289C14.2623 4.0499 14.7372 4.04975 15.0302 4.34255Z" fill="#323544"/>
<path d="M18.2198 4.34255C17.9269 4.63535 17.9267 5.11022 18.2195 5.40321L20.1897 7.37465L18.2195 9.34624C17.9267 9.63924 17.9269 10.1141 18.2199 10.4069C18.5129 10.6997 18.9877 10.6995 19.2805 10.4065L21.7805 7.90478C22.0732 7.61192 22.0732 7.13732 21.7805 6.84448L19.2805 4.34289C18.9877 4.0499 18.5128 4.04975 18.2198 4.34255Z" fill="#323544"/>
</svg>

                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Middleware Pipeline</h3>
                    <p class="text-gray-600">Rate limiting, request throttling, and extensible middleware system for enhanced security.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M21 8.62565H15.3753V3.00098H21V8.62565Z" fill="#323544"/>
<path d="M14.8118 8.62565H9.1871V3.00098H14.8118V8.62565Z" fill="#323544"/>
<path d="M8.62467 8.62565H3V3.00098H8.62467V8.62565Z" fill="#323544"/>
<path d="M21 14.8129H15.3753V9.18819H21V14.8129Z" fill="#323544"/>
<path d="M14.8118 14.8129H9.1871V9.18819H14.8118V14.8129Z" fill="#323544"/>
<path d="M14.8118 21H9.1871V15.3753H14.8118V21Z" fill="#323544"/>
<path d="M21 21H15.3753V15.3753H21V21Z" fill="#323544"/>
<path d="M8.62467 21H3V15.3753H8.62467V21Z" fill="#323544"/>
</svg>


                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Advanced DI Container</h3>
                    <p class="text-gray-600">Interface binding, auto-resolution, and singleton management for clean architecture.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M12.6538 9.9879C13.1993 10.1607 13.5563 10.5316 13.7248 11.1005V14.2807H16.1482V14.2775H16.521V14.2709H16.5558V8.87531C16.2778 7.93664 15.689 7.32399 14.7896 7.03739H3.94294C3.04333 7.32293 2.4546 7.93557 2.17676 8.87531V20.2179C2.45479 21.1565 3.05616 21.7505 3.98085 22H14.7517C15.6764 21.7505 16.2778 21.1565 16.5558 20.2179V17.2608H13.7248V17.973C13.5563 18.5419 13.1919 18.9018 12.6317 19.0528H6.10404C5.54375 18.9018 5.17936 18.5419 5.01086 17.973V11.1005C5.17936 10.5316 5.53639 10.1607 6.08191 9.9879H12.6538Z" fill="#323544"/>
<path d="M21.8237 3.83792C21.5457 2.89927 20.9569 2.28663 20.0575 2H9.21086C8.31144 2.28663 7.72274 2.89927 7.44467 3.83792V6.72279H10.2756V6.06312C10.4441 5.49424 10.8011 5.12338 11.3467 4.9505H17.9185C18.4641 5.12338 18.8211 5.49424 18.9896 6.06312V12.9356C18.8211 13.5045 18.4567 13.8644 17.8964 14.0154H11.3688C10.8085 13.8644 10.4441 13.5045 10.2756 12.9356V9.6733H7.44467V15.1805C7.72274 16.1191 8.32407 16.7132 9.24874 16.9626H20.0196C20.9443 16.7132 21.5457 16.1191 21.8237 15.1805V3.83792Z" fill="#323544"/>
</svg>

                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">High Performance</h3>
                    <p class="text-gray-600">Optimized routing with middleware caching and efficient request handling.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4">
                        <svg width="56" height="56" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M6.38688 7.48329C6.45702 4.44302 8.94354 2 12.0007 2C15.0578 2 17.5444 4.44308 17.6144 7.48338C20.0688 7.67706 22.0001 9.7301 22.0001 12.2342C22.0001 12.2685 21.9997 12.3027 21.999 12.3368C21.4783 11.685 20.8414 11.13 20.1197 10.7032C19.571 9.67117 18.4847 8.96844 17.2343 8.96844H16.866C16.4518 8.96844 16.116 8.63266 16.116 8.21844V7.6153C16.116 5.34248 14.2735 3.5 12.0007 3.5C9.72784 3.5 7.88536 5.34248 7.88536 7.6153V8.21844C7.88536 8.63266 7.54957 8.96844 7.13536 8.96844H6.76578C4.96214 8.96844 3.5 10.4306 3.5 12.2342C3.5 14.0379 4.96214 15.5 6.76577 15.5H9.84159C9.78134 15.8661 9.75 16.2419 9.75 16.625C9.75 16.7508 9.75338 16.8758 9.76005 17H6.76577C4.13371 17 2 14.8663 2 12.2342C2 9.72969 3.93195 7.67638 6.38688 7.48329Z" fill="#323544"/>
<path d="M18.6553 15.1408C18.9482 15.4337 18.9482 15.9086 18.6553 16.2015L16.7477 18.1092C16.607 18.2498 16.4163 18.3288 16.2173 18.3288C16.0184 18.3288 15.8277 18.2498 15.687 18.1092L14.5947 17.0168C14.3018 16.7239 14.3018 16.2491 14.5947 15.9562C14.8876 15.6633 15.3625 15.6633 15.6553 15.9562L16.2173 16.5182L17.5947 15.1408C17.8876 14.8479 18.3625 14.8479 18.6553 15.1408Z" fill="#323544"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.25 16.625C11.25 13.6565 13.6565 11.25 16.625 11.25C19.5935 11.25 22 13.6565 22 16.625C22 19.5935 19.5935 22 16.625 22C13.6565 22 11.25 19.5935 11.25 16.625ZM16.625 12.75C14.4849 12.75 12.75 14.4849 12.75 16.625C12.75 18.7651 14.4849 20.5 16.625 20.5C18.7651 20.5 20.5 18.7651 20.5 16.625C20.5 14.4849 18.7651 12.75 16.625 12.75Z" fill="#323544"/>
</svg>

                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">Clean Architecture</h3>
                    <p class="text-gray-600">Separation of concerns with proper exception handling and modular design.</p>
                </div>

                <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition duration-200">
                    <div class="text-4xl mb-4">
                        <svg width="56" height="55" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M15.0582 4.16286C15.1481 3.75851 14.8931 3.35788 14.4888 3.26802C14.0844 3.17816 13.6838 3.43311 13.5939 3.83746L10.0384 19.8374C9.94851 20.2418 10.2035 20.6424 10.6078 20.7323C11.0122 20.8221 11.4128 20.5672 11.5026 20.1628L15.0582 4.16286Z" fill="#323544"/>
<path d="M7.82913 7.46956C8.12204 7.76244 8.12206 8.23732 7.82918 8.53022L4.35946 12.0003L7.82916 15.47C8.12205 15.7628 8.12205 16.2377 7.82916 16.5306C7.53627 16.8235 7.06139 16.8235 6.7685 16.5306L2.7685 12.5306C2.47561 12.2377 2.4756 11.7629 2.76847 11.47L6.76847 7.46961C7.06135 7.1767 7.53623 7.17668 7.82913 7.46956Z" fill="#323544"/>
<path d="M17.2685 7.46956C16.9756 7.76244 16.9756 8.23732 17.2685 8.53022L20.7382 12.0003L17.2685 15.47C16.9756 15.7628 16.9756 16.2377 17.2685 16.5306C17.5614 16.8235 18.0363 16.8235 18.3292 16.5306L22.3292 12.5306C22.622 12.2377 22.6221 11.7629 22.3292 11.47L18.3292 7.46961C18.0363 7.1767 17.5614 7.17668 17.2685 7.46956Z" fill="#323544"/>
</svg>

                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-gray-900">CLI Tools</h3>
                    <p class="text-gray-600">Laravel Artisan-like command line interface for streamlined development.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Start Section -->
    <section class="py-20 bg-gray-900 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Quick Start</h2>
                <p class="text-xl text-gray-300">Get up and running in minutes</p>
            </div>

            <div class="max-w-4xl mx-auto">
                <div class="bg-gray-800 rounded-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-yellow-500 rounded-full"></div>
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                        </div>
                        <span class="ml-4 text-gray-400 text-sm">Terminal</span>
                    </div>
                    <div class="font-mono text-sm">
                        <div class="text-green-400">$ git clone https://github.com/aoamusat/fortress.git</div>
                        <div class="text-green-400">$ cd fortress</div>
                        <div class="text-green-400">$ composer install</div>
                        <div class="text-green-400">$ php fortress run</div>
                        <div class="text-gray-400 mt-2">Server running on http://localhost:8000</div>
                    </div>
                </div>

                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <h3 class="font-semibold mb-2">Install</h3>
                        <p class="text-gray-400 text-sm">Clone and install dependencies with Composer</p>
                    </div>
                    <div class="text-center">
                        <h3 class="font-semibold mb-2">Configure</h3>
                        <p class="text-gray-400 text-sm">Set up your database in config.php</p>
                    </div>
                    <div class="text-center">
                        <h3 class="font-semibold mb-2">Deploy</h3>
                        <p class="text-gray-400 text-sm">Start the development server and build</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="py-20 bg-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Security First</h2>
                <p class="text-xl text-gray-600">Built with enterprise-grade security from the ground up</p>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h3 class="text-2xl font-semibold mb-6 text-gray-900">Protection Against Common Threats</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="text-green-500 mr-3 mt-1"></div>
                            <div>
                                <strong>SQL Injection Protection</strong><br>
                                <span class="text-gray-600">Parameterized queries with PDO and input sanitization</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-green-500 mr-3 mt-1"></div>
                            <div>
                                <strong>Rate Limiting & Throttling</strong><br>
                                <span class="text-gray-600">Configurable request limits and throttling middleware</span>
                            </div>
                        </div>
                        <div class="flex items-start">
                            <div class="text-green-500 mr-3 mt-1"></div>
                            <div>
                                <strong>Secure Database Layer</strong><br>
                                <span class="text-gray-600">Secure connection handling and query validation</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-900 text-white p-6 rounded-lg">
                    <div class="text-sm text-gray-400 mb-2">Security Configuration</div>
                    <pre class="text-sm"><code>// Rate limiting middleware
$router->middleware(new RateLimitMiddleware(100, 60))
       ->middleware(new ThrottleMiddleware(1));

// Secure database queries
$user = User::where('email', $email)->first();
// Automatically sanitized and parameterized</code></pre>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h3 class="text-2xl font-bold mb-4">Fortress</h3>
                <p class="text-gray-400 mb-6">Secure, enterprise-grade PHP framework for modern applications</p>
                <div class="flex justify-center space-x-6">
                    <a href="https://github.com/aoamusat/fortress" class="text-gray-400 hover:text-white transition duration-200">GitHub</a>
                    <a href="https://github.com/aoamusat/fortress" class="text-gray-400 hover:text-white transition duration-200">About</a>
                    <a href="https://github.com/aoamusat/fortress" class="text-gray-400 hover:text-white transition duration-200">Contact</a>
                </div>
                <div class="mt-8 pt-8 border-t border-gray-800">
                    <p class="text-gray-500 text-sm"> &copy; 2024 Fortress Framework. Licensed under MIT License.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>