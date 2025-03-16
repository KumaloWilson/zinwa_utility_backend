<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zinwa Water Meter Utility API Documentation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/atom-one-dark.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                            950: '#082f49',
                        },
                        secondary: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            200: '#99f6e4',
                            300: '#5eead4',
                            400: '#2dd4bf',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                            950: '#042f2e',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        mono: ['JetBrains Mono', 'monospace'],
                    },
                    boxShadow: {
                        'inner-lg': 'inset 0 2px 4px 0 rgba(0, 0, 0, 0.06)',
                    },
                },
            },
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500&display=swap');

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        .dark ::-webkit-scrollbar-track {
            background: #1e293b;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .dark ::-webkit-scrollbar-thumb {
            background: #475569;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .dark ::-webkit-scrollbar-thumb:hover {
            background: #64748b;
        }

        /* Code block styles */
        pre code {
            border-radius: 0.5rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.875rem;
            line-height: 1.5;
        }

        /* Method badge styles */
        .method-badge {
            @apply inline-flex items-center justify-center px-3 py-1 text-xs font-medium rounded-full w-16;
        }

        .method-get {
            @apply bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300;
        }

        .method-post {
            @apply bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300;
        }

        .method-put {
            @apply bg-amber-100 text-amber-800 dark:bg-amber-900 dark:text-amber-300;
        }

        .method-delete {
            @apply bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300;
        }

        /* Endpoint card hover effect */
        .endpoint-card {
            @apply transition-all duration-300 ease-in-out;
        }

        .endpoint-card:hover {
            @apply shadow-lg transform -translate-y-1;
        }

        /* Smooth scrolling for anchor links */
        html {
            scroll-behavior: smooth;
        }

        /* Active section highlight */
        .section-link.active {
            @apply bg-primary-50 text-primary-700 border-l-4 border-primary-500 dark:bg-slate-800 dark:text-primary-400 dark:border-primary-400;
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 dark:bg-slate-900 dark:text-slate-100 min-h-screen font-sans antialiased">
<!-- Dark mode toggle -->
<div class="fixed top-4 right-4 z-50">
    <button id="theme-toggle" class="p-2 rounded-full bg-white dark:bg-slate-800 shadow-md hover:shadow-lg transition-all duration-300">
        <!-- Sun icon for dark mode -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
        </svg>
        <!-- Moon icon for light mode -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-700 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
        </svg>
    </button>
</div>

<div class="flex flex-col lg:flex-row">
    <!-- Sidebar Navigation -->
    <aside class="lg:fixed lg:inset-y-0 lg:left-0 lg:w-72 bg-white dark:bg-slate-800 shadow-md lg:overflow-y-auto z-10">
        <div class="p-6">
            <div class="flex items-center space-x-3 mb-8">
                <div class="h-10 w-10 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h1 class="text-xl font-bold text-slate-900 dark:text-white">Zinwa API</h1>
            </div>

            <nav class="space-y-1">
                <a href="#introduction" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Introduction</a>
                <a href="#authentication" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Authentication</a>

                <div class="pt-2">
                    <p class="px-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Endpoints</p>
                    <a href="#users" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Users & Auth</a>
                    <a href="#meters" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Meters</a>
                    <a href="#tokens" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Tokens</a>
                    <a href="#payments" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Payments</a>
                    <a href="#tariffs" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Tariffs</a>
                    <a href="#notifications" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Notifications</a>
                    <a href="#admin" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Admin</a>
                </div>

                <a href="#errors" class="section-link block px-4 py-2 rounded-md hover:bg-slate-100 dark:hover:bg-slate-700 transition-colors">Error Handling</a>
            </nav>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 lg:ml-72">
        <div class="max-w-4xl mx-auto px-4 py-8 lg:px-8 lg:py-12">
            <!-- Introduction Section -->
            <section id="introduction" class="mb-16">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Introduction</h2>
                </div>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-lg">
                        Welcome to the Zinwa Water Meter Utility API documentation. This API allows you to interact with the Zinwa water meter system,
                        manage users, meters, tokens, payments, and more.
                    </p>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Base URL</h3>
                    <div class="bg-slate-800 text-white rounded-lg p-4 font-mono text-sm">
                        https://api.zinwa.com/api
                    </div>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Content Type</h3>
                    <p>All requests and responses use JSON format. Ensure your requests include the header:</p>
                    <div class="bg-slate-800 text-white rounded-lg p-4 font-mono text-sm">
                        Content-Type: application/json<br>
                        Accept: application/json
                    </div>
                </div>
            </section>

            <!-- Authentication Section -->
            <section id="authentication" class="mb-16">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Authentication</h2>
                </div>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-lg">
                        The API uses Laravel Sanctum for authentication. After logging in, you'll receive a token that should be included in the
                        Authorization header for all authenticated requests.
                    </p>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Authentication Header</h3>
                    <div class="bg-slate-800 text-white rounded-lg p-4 font-mono text-sm">
                        Authorization: Bearer {your_token}
                    </div>

                    <div class="mt-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg dark:bg-amber-900/30 dark:border-amber-600">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-amber-800 dark:text-amber-200">
                                    <strong>Note:</strong> Most endpoints require authentication. Public endpoints will be marked as such.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Users & Authentication Section -->
            <section id="users" class="mb-16">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Users & Authentication</h2>
                </div>

                <!-- Register Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-post">POST</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/register</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300">Public</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Register a new user account.</p>

                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Request Parameters</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Parameter</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Required</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">name</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Full name of the user</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">email</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Email address (must be unique)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">phone</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Phone number (must be unique if provided)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">password</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Password (min 8 characters)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">password_confirmation</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Confirm password</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Example Request</h4>
                                <button class="copy-button text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <pre><code class="language-json rounded-lg">{
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "password": "password123",
    "password_confirmation": "password123"
}</code></pre>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Example Response (201 Created)</h4>
                                <button class="copy-button text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <pre><code class="language-json rounded-lg">{
    "message": "User registered successfully",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "role": "consumer",
        "status": "active",
        "email_verified": false,
        "phone_verified": false,
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T12:00:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Login Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-post">POST</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/login</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300">Public</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Authenticate a user and get an access token.</p>

                        <div class="mb-6">
                            <h4 class="text-sm font-semibold text-slate-900 dark:text-white mb-2">Request Parameters</h4>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                                    <thead class="bg-slate-50 dark:bg-slate-700/50">
                                    <tr>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Parameter</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Type</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Required</th>
                                        <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Description</th>
                                    </tr>
                                    </thead>
                                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">email</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Email address</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">password</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Password</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Example Request</h4>
                                <button class="copy-button text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <pre><code class="language-json rounded-lg">{
    "email": "john@example.com",
    "password": "password123"
}</code></pre>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Example Response (200 OK)</h4>
                                <button class="copy-button text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <pre><code class="language-json rounded-lg">{
    "message": "Login successful",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "+1234567890",
        "role": "consumer",
        "status": "active",
        "email_verified": false,
        "phone_verified": false,
        "last_login_at": "2023-05-20T12:30:00.000000Z",
        "created_at": "2023-05-20T12:00:00.000000Z",
        "updated_at": "2023-05-20T12:30:00.000000Z"
    },
    "token": "1|abcdefghijklmnopqrstuvwxyz123456"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Additional endpoints would continue here -->
                <!-- For brevity, I'm showing just a couple of examples -->

                <!-- Logout Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-post">POST</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/logout</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Revoke the current access token.</p>

                        <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg dark:bg-blue-900/30 dark:border-blue-600">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-500 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-800 dark:text-blue-200">
                                        <strong>Authentication Required:</strong> Bearer Token
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <h4 class="text-sm font-semibold text-slate-900 dark:text-white">Example Response (200 OK)</h4>
                                <button class="copy-button text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-300 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                    Copy
                                </button>
                            </div>
                            <pre><code class="language-json rounded-lg">{
    "message": "Successfully logged out"
}</code></pre>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Additional sections would continue here -->
            <!-- For brevity, I'm showing just a couple of examples -->

            <!-- Error Handling Section -->
            <section id="errors" class="mb-16">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-red-500 to-orange-500 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Error Handling</h2>
                </div>

                <div class="prose prose-slate dark:prose-invert max-w-none">
                    <p class="text-lg">
                        The API uses standard HTTP status codes to indicate the success or failure of a request. In case of an error,
                        the response will include a message explaining what went wrong.
                    </p>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Common Error Codes</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status Code</th>
                                <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Description</th>
                            </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-200 dark:divide-slate-700">
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">400</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Bad Request - The request was invalid or cannot be served</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">401</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Unauthorized - Authentication is required or has failed</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">403</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Forbidden - The authenticated user does not have permission to access the requested resource</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">404</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Not Found - The requested resource does not exist</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">422</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Unprocessable Entity - The request was well-formed but contains semantic errors (validation failed)</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">429</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Too Many Requests - The user has sent too many requests in a given amount of time</td>
                            </tr>
                            <tr>
                                <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">500</td>
                                <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Internal Server Error - An error occurred on the server</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Validation Error Example</h3>
                    <pre><code class="language-json rounded-lg">{
    "message": "The given data was invalid.",
    "errors": {
        "email": [
            "The email field is required."
        ],
        "password": [
            "The password field is required."
        ]
    }
}</code></pre>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Authentication Error Example</h3>
                    <pre><code class="language-json rounded-lg">{
    "message": "Unauthenticated."
}</code></pre>

                    <h3 class="text-xl font-semibold mt-8 mb-4">Authorization Error Example</h3>
                    <pre><code class="language-json rounded-lg">{
    "message": "Unauthorized. You do not have the required role to access this resource."
}</code></pre>
                </div>
            </section>
        </div>
    </main>
</div>

<!-- JavaScript for functionality -->
<script>
    // Initialize syntax highlighting
    document.addEventListener('DOMContentLoaded', () => {
        hljs.highlightAll();

        // Dark mode toggle
        const themeToggle = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        // Check for saved theme preference or use system preference
        if (localStorage.getItem('theme') === 'dark' ||
            (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            htmlElement.classList.add('dark');
        } else {
            htmlElement.classList.remove('dark');
        }

        // Toggle theme
        themeToggle.addEventListener('click', () => {
            htmlElement.classList.toggle('dark');

            // Save preference
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });

        // Copy buttons functionality
        document.querySelectorAll('.copy-button').forEach(button => {
            button.addEventListener('click', () => {
                const codeBlock = button.closest('div').querySelector('code');
                const textToCopy = codeBlock.textContent;

                navigator.clipboard.writeText(textToCopy).then(() => {
                    // Show copied feedback
                    const originalText = button.innerHTML;
                    button.innerHTML = `
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Copied!
                        `;

                    setTimeout(() => {
                        button.innerHTML = originalText;
                    }, 2000);
                });
            });
        });

        // Active section highlighting
        const sections = document.querySelectorAll('section[id]');
        const navLinks = document.querySelectorAll('.section-link');

        function highlightActiveSection() {
            const scrollPosition = window.scrollY;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute('id');

                if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        }

        window.addEventListener('scroll', highlightActiveSection);
        highlightActiveSection(); // Initial call
    });
</script>
</body>
</html>

