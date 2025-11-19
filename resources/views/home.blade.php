<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 font-sans">

    {{-- Hero Section --}}
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4 text-center">Welcome to the Student Management System</h1>
        <p class="text-lg md:text-xl mb-8 text-center max-w-2xl">
            Manage students, courses, batches, enrollments, and payments efficiently and professionally.
        </p>

        <div class="flex flex-col md:flex-row gap-4 mb-12">
            <a href="{{ route('student.login') }}" 
               class="px-8 py-4 bg-green-500 hover:bg-green-600 rounded shadow-lg text-lg font-semibold transition duration-300 text-white text-center">
               Student Login
            </a>
            <a href="{{ route('admin.login') }}" 
               class="px-8 py-4 bg-yellow-500 hover:bg-yellow-600 rounded shadow-lg text-lg font-semibold transition duration-300 text-white text-center">
               Admin Login
            </a>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl">
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-800">
                <h3 class="text-lg font-semibold mb-2">Total Students</h3>
                <p class="text-2xl font-bold" id="totalStudents">120</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-800">
                <h3 class="text-lg font-semibold mb-2">Total Courses</h3>
                <p class="text-2xl font-bold" id="totalCourses">15</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-800">
                <h3 class="text-lg font-semibold mb-2">Total Payments (FCFA)</h3>
                <p class="text-2xl font-bold" id="totalPayments">1,250,000</p>
            </div>
        </div>
    </div>

    {{-- Features Section --}}
    <div class="bg-white py-16">
        <div class="max-w-6xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-12 text-gray-800">Why Use Our System?</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="text-xl font-semibold mb-4">Student Management</h3>
                    <p>Keep track of student details, enrollments, and progress in an organized way.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="text-xl font-semibold mb-4">Course & Batch Management</h3>
                    <p>Efficiently manage courses, batches, and associated teachers with ease.</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg shadow hover:shadow-lg transition duration-300">
                    <h3 class="text-xl font-semibold mb-4">Payments Tracking</h3>
                    <p>Track student payments, generate receipts, and get monthly summaries quickly.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="max-w-6xl mx-auto px-4 text-center">
            &copy; {{ date('Y') }} Student Management System. All rights reserved.
        </div>
    </footer>

    {{-- Chart Animation --}}
    <script>
        // Animate the stats cards numbers
        function animateValue(id, start, end, duration) {
            let obj = document.getElementById(id);
            let range = end - start;
            let current = start;
            let increment = end > start ? 1 : -1;
            let stepTime = Math.abs(Math.floor(duration / range));
            let timer = setInterval(function() {
                current += increment;
                obj.textContent = current.toLocaleString();
                if (current == end) {
                    clearInterval(timer);
                }
            }, stepTime);
        }

        animateValue("totalStudents", 0, 120, 1500);
        animateValue("totalCourses", 0, 15, 1500);
        animateValue("totalPayments", 0, 1250000, 1500);
    </script>
</body>
</html>
