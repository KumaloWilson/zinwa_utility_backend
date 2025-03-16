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

                <!-- Get User Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-get">GET</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/user</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Get the authenticated user's details.</p>

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
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "phone": "+1234567890",
    "role": "consumer",
    "status": "active",
    "email_verified": true,
    "phone_verified": false,
    "last_login_at": "2023-05-20T12:30:00.000000Z",
    "created_at": "2023-05-20T12:00:00.000000Z",
    "updated_at": "2023-05-20T12:30:00.000000Z"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Email Verification Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-get">GET</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/email/verify/{id}/{hash}</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-300">Public</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Verify a user's email address.</p>

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
    "message": "Email verified successfully"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Email Verification Notification Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-post">POST</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/email/verification-notification</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Resend the email verification notification.</p>

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
    "message": "Verification link sent"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Phone Verification Endpoint -->
                <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <span class="method-badge method-post">POST</span>
                                <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/phone/verification</h3>
                            </div>
                            <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                        </div>

                        <p class="mb-4 text-slate-600 dark:text-slate-300">Send a verification code to the user's phone.</p>

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
                                        <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">phone</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                        <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Phone number to verify</td>
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
    "phone": "+1234567890"
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
    "message": "Verification code sent to your phone"
}</code></pre>
                        </div>
                    </div>
                </div>

                <!-- Continue with other user endpoints -->
                <!-- For brevity, I'll add just a few more key endpoints -->

                <!-- Meters Section -->
                <section id="meters" class="mb-16 mt-24">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Meters</h2>
                    </div>

                    <!-- Get Meters Endpoint -->
                    <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <span class="method-badge method-get">GET</span>
                                    <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/meters</h3>
                                </div>
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                            </div>

                            <p class="mb-4 text-slate-600 dark:text-slate-300">Get all meters for the authenticated user.</p>

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
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "meter_number": "ZW12345678",
            "meter_type": "prepaid",
            "location": "123 Main St, Harare",
            "status": "active",
            "last_reading": 1250.5,
            "last_reading_date": "2023-05-15T10:00:00.000000Z",
            "installation_date": "2023-01-01T00:00:00.000000Z",
            "is_validated": true,
            "validation_date": "2023-01-02T00:00:00.000000Z",
            "notes": "Main residence meter",
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/meters?page=1",
        "last": "http://api.zinwa.com/api/meters?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/meters",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                            </div>
                        </div>
                    </div>

                    <!-- Register Meter Endpoint -->
                    <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <span class="method-badge method-post">POST</span>
                                    <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/meters</h3>
                                </div>
                                <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                            </div>

                            <p class="mb-4 text-slate-600 dark:text-slate-300">Register a new meter for the authenticated user.</p>

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
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">meter_number</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Yes</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Unique meter number</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">meter_type</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Type of meter (prepaid, postpaid)</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">location</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Physical location of the meter</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">installation_date</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">date</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Date of installation</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">notes</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">string</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Additional notes about the meter</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 py-3 text-sm font-medium text-slate-900 dark:text-white">validate</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">boolean</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">No</td>
                                            <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">Whether to validate the meter with the utility provider</td>
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
    "meter_number": "ZW87654321",
    "meter_type": "prepaid",
    "location": "456 Park Ave, Bulawayo",
    "notes": "Business premises meter",
    "validate": true
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
    "message": "Meter registered successfully",
    "meter": {
        "id": 2,
        "user_id": 1,
        "meter_number": "ZW87654321",
        "meter_type": "prepaid",
        "location": "456 Park Ave, Bulawayo",
        "status": "active",
        "last_reading": 0,
        "last_reading_date": null,
        "installation_date": "2023-05-20T13:30:00.000000Z",
        "is_validated": true,
        "validation_date": "2023-05-20T13:30:00.000000Z",
        "notes": "Business premises meter",
        "created_at": "2023-05-20T13:30:00.000000Z",
        "updated_at": "2023-05-20T13:30:00.000000Z"
    }
}</code></pre>
                            </div>
                        </div>
                    </div>

                    <!-- Tokens Section -->
                    <section id="tokens" class="mb-16 mt-24">
                        <div class="flex items-center space-x-4 mb-6">
                            <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 9a2 2 0 10-4 0v5a2 2 0 01-2 2h6m-6-4h4m8 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tokens</h2>
                        </div>

                        <!-- Get Tokens Endpoint -->
                        <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <span class="method-badge method-get">GET</span>
                                        <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/tokens</h3>
                                    </div>
                                    <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                                </div>

                                <p class="mb-4 text-slate-600 dark:text-slate-300">Get all tokens for the authenticated user.</p>

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
    "data": [
        {
            "id": 5,
            "user_id": 1,
            "meter_id": 1,
            "transaction_id": 5,
            "token_number": "12345678901234567890",
            "units": 50.5,
            "amount": 75.75,
            "status": "used",
            "generated_at": "2023-05-15T09:00:00.000000Z",
            "used_at": "2023-05-15T10:00:00.000000Z",
            "expires_at": "2023-06-14T09:00:00.000000Z",
            "created_at": "2023-05-15T09:00:00.000000Z",
            "updated_at": "2023-05-15T10:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/tokens?page=1",
        "last": "http://api.zinwa.com/api/tokens?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/tokens",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                                </div>
                            </div>
                        </div>

                        <!-- Payments Section -->
                        <section id="payments" class="mb-16 mt-24">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Payments</h2>
                            </div>

                            <!-- Get Transactions Endpoint -->
                            <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="method-badge method-get">GET</span>
                                            <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/transactions</h3>
                                        </div>
                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                                    </div>

                                    <p class="mb-4 text-slate-600 dark:text-slate-300">Get all transactions for the authenticated user.</p>

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
    "data": [
        {
            "id": 6,
            "user_id": 1,
            "meter_id": 1,
            "reference": "TXN-ghijkl5678",
            "amount": 150.00,
            "payment_method": "test",
            "payment_provider": null,
            "status": "completed",
            "currency": "USD",
            "description": "Test token generation",
            "metadata": null,
            "completed_at": "2023-05-20T15:00:00.000000Z",
            "refunded_at": null,
            "created_at": "2023-05-20T15:00:00.000000Z",
            "updated_at": "2023-05-20T15:00:00.000000Z"
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/transactions?page=1",
        "last": "http://api.zinwa.com/api/transactions?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/transactions",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Handling Section -->
                            <section id="errors" class="mb-16 mt-24">
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
                        </section>

                        <!-- Tariffs Section -->
                        <section id="tariffs" class="mb-16 mt-24">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Tariffs</h2>
                            </div>

                            <!-- Get Tariffs Endpoint -->
                            <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="method-badge method-get">GET</span>
                                            <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/tariffs</h3>
                                        </div>
                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                                    </div>

                                    <p class="mb-4 text-slate-600 dark:text-slate-300">Get all active tariffs.</p>

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
    "data": [
        {
            "id": 1,
            "name": "Residential Basic",
            "description": "Basic tariff for residential customers (0-50 units)",
            "rate_per_unit": 0.50,
            "min_units": 0,
            "max_units": 50,
            "tax_percentage": 5.0,
            "service_fee": 2.00,
            "is_active": true,
            "effective_from": "2023-01-01T00:00:00.000000Z",
            "effective_to": null,
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-01-01T00:00:00.000000Z"
        },
        {
            "id": 2,
            "name": "Residential Standard",
            "description": "Standard tariff for residential customers (51-200 units)",
            "rate_per_unit": 0.75,
            "min_units": 51,
            "max_units": 200,
            "tax_percentage": 5.0,
            "service_fee": 2.00,
            "is_active": true,
            "effective_from": "2023-01-01T00:00:00.000000Z",
            "effective_to": null,
            "created_at": "2023-01-01T00:00:00.000000Z",
            "updated_at": "2023-01-01T00:00:00.000000Z"
        }
    ]
}</code></pre>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Notifications Section -->
                        <section id="notifications" class="mb-16 mt-24">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Notifications</h2>
                            </div>

                            <!-- Get Notifications Endpoint -->
                            <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="method-badge method-get">GET</span>
                                            <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/notifications</h3>
                                        </div>
                                        <span class="px-3 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300">Authenticated</span>
                                    </div>

                                    <p class="mb-4 text-slate-600 dark:text-slate-300">Get all notifications for the authenticated user.</p>

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
    "data": [
        {
            "id": 1,
            "user_id": 1,
            "title": "Token Generated",
            "message": "Your token for 50 units has been generated successfully. Token: 34567890123456789012",
            "type": "token",
            "read_at": null,
            "data": {
                "token_id": 7,
                "token_number": "34567890123456789012",
                "units": 50,
                "meter_id": 1,
                "meter_number": "ZW12345678"
            },
            "created_at": "2023-05-20T16:05:00.000000Z",
            "updated_at": "2023-05-20T16:05:00.000000Z",
            "is_read": false
        }
    ],
    "links": {
        "first": "http://api.zinwa.com/api/notifications?page=1",
        "last": "http://api.zinwa.com/api/notifications?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http://api.zinwa.com/api/notifications",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}</code></pre>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- Admin Section -->
                        <section id="admin" class="mb-16 mt-24">
                            <div class="flex items-center space-x-4 mb-6">
                                <div class="h-12 w-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-bold text-slate-900 dark:text-white">Admin</h2>
                            </div>

                            <div class="mb-6 p-4 bg-amber-50 border-l-4 border-amber-500 rounded-r-lg dark:bg-amber-900/30 dark:border-amber-600">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-amber-500 dark:text-amber-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm text-amber-800 dark:text-amber-200">
                                            <strong>Note:</strong> All admin endpoints require authentication with an admin user.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Get Dashboard Endpoint -->
                            <div class="endpoint-card mb-8 bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3">
                                            <span class="method-badge method-get">GET</span>
                                            <h3 class="text-lg font-semibold font-mono text-slate-900 dark:text-white">/admin/dashboard</h3>
                                        </div>
                                        <span class="px-3 py-1 text-xs rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300">Admin</span>
                                    </div>

                                    <p class="mb-4 text-slate-600 dark:text-slate-300">Get dashboard statistics.</p>

                                    <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 rounded-r-lg dark:bg-blue-900/30 dark:border-blue-600">
                                        <div class="flex">
                                            <div class="flex-shrink-0">
                                                <svg class="h-5 w-5 text-blue-500 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-blue-800 dark:text-blue-200">
                                                    <strong>Authentication Required:</strong> Bearer Token (Admin)
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
    "total_users": 15,
    "total_meters": 20,
    "total_tokens": 150,
    "total_revenue": 12500.75,
    "recent_transactions": [
        {
            "id": 7,
            "user_id": 1,
            "meter_id": 1,
            "reference": "TXN-mnopqr9012",
            "amount": 75.00,
            "payment_method": "mobile_money",
            "payment_provider": "EcoCash",
            "status": "completed",
            "currency": "USD",
            "description": "Purchase of 50 units for meter ZW12345678",
            "metadata": null,
            "completed_at": "2023-05-20T16:05:00.000000Z",
            "refunded_at": null,
            "created_at": "2023-05-20T16:00:00.000000Z",
            "updated_at": "2023-05-20T16:05:00.000000Z",
            "user": {
                "id": 1,
                "name": "John Smith",
                "email": "john@example.com"
            },
            "meter": {
                "id": 1,
                "meter_number": "ZW12345678"
            }
        }
    ],
    "users_by_role": [
        {
            "role": "admin",
            "count": 1
        },
        {
            "role": "vendor",
            "count": 2
        },
        {
            "role": "consumer",
            "count": 12
        }
    ],
    "transactions_by_day": [
        {
            "date": "2023-05-01",
            "total": 450.00
        },
        {
            "date": "2023-05-15",
            "total": 75.75
        },
        {
            "date": "2023-05-20",
            "total": 225.00
        }
    ]
}</code></pre>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </section>
                </section>
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

