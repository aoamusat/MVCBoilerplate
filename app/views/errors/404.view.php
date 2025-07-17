<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Fortress</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <?php include __DIR__ . '/../partials/nav.view.php'; ?>
    
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full text-center">
            <div class="mb-8">
                <div class="text-9xl font-bold text-gray-300 mb-4">404</div>
                <div class="text-6xl mb-6">🏰</div>
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Page Not Found</h1>
                <p class="text-gray-600 mb-8">
                    The fortress walls are strong, but this page seems to have wandered off. 
                    The route you're looking for doesn't exist in our secure perimeter.
                </p>
            </div>
            
            <div class="space-y-4">
                <a href="/" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                    Return to Safety
                </a>
                <div class="text-sm text-gray-500">
                    <p>If you believe this is an error, please contact the fortress guards.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <p class="text-gray-400"> &copy; 2025 Fortress Framework. All routes secured.</p>
        </div>
    </footer>
</body>
</html>