<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}"></script>
</head>
<body class="bg-gray-50">
    <header class="bg-blue-600 text-white p-4">
        <h1 class="text-xl font-bold">Student Portal</h1>
    </header>

    <nav class="bg-white p-4 shadow">
        <ul class="flex space-x-4">
            <li><a href="{{ route('student.dashboard') }}" class="text-blue-600">Dashboard</a></li>
            <li><a href="{{ route('student.courses') }}" class="text-gray-700">Courses</a></li>
            <li><a href="{{ route('student.payments') }}" class="text-gray-700">Payments</a></li>
            <li><a href="{{ route('logout') }}" class="text-red-600">Logout</a></li>
        </ul>
    </nav>

    <main class="p-6">
        @yield('content')
    </main>
</body>
</html>
