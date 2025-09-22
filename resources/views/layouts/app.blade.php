<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Student Management</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">🏠 Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('students.index') }}">Students</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('teachers.index') }}">Teachers</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('courses.index') }}">Courses</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('batch.index') }}">Batches</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('enrollments.index') }}">Enrollments</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('payments.index') }}">Payments</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>