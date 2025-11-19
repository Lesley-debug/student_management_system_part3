<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow: hidden;
        }
        .sidebar {
            height: 100vh;
            background: #343a40;
            color: white;
        }
        .sidebar h4 {
            padding: 15px;
            border-bottom: 1px solid #495057;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            background: #495057;
        }
        .content {
            height: 100vh;
            overflow-y: auto;
            padding: 20px;
        }
        .card {
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar p-0">
            <h4>📊 Dashboard</h4>
            <a href="{{ route('home') }}">🏠 Home</a>
            <a href="{{ route('students.index') }}">👨‍🎓 Students</a>
            <a href="{{ route('teachers.index') }}">👩‍🏫 Teachers</a>
            <a href="{{ route('courses.index') }}">📘 Courses</a>
            <a href="{{ route('batch.index') }}">📅 Batches</a>
            <a href="{{ route('enrollments.index') }}">📝 Enrollments</a>
            <a href="{{ route('payments.index') }}">💵 Payments</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 content">
            <h2 class="mb-4">School Management Dashboard</h2>

            <div class="row">
                <!-- Students -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>👨‍🎓 Students</h5>
                        <h2 class="counter" data-target="{{ $studentsCount }}">0</h2>
                    </div>
                </div>

                <!-- Teachers -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>👩‍🏫 Teachers</h5>
                        <h2 class="counter" data-target="{{ $teachersCount }}">0</h2>
                    </div>
                </div>

                <!-- Courses -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>📘 Courses</h5>
                        <h2 class="counter" data-target="{{ $coursesCount }}">0</h2>
                    </div>
                </div>

                <!-- Batches -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>📅 Batches</h5>
                        <h2 class="counter" data-target="{{ $batchesCount }}">0</h2>
                    </div>
                </div>

                <!-- Enrollments -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>📝 Enrollments</h5>
                        <h2 class="counter" data-target="{{ $enrollmentsCount }}">0</h2>
                    </div>
                </div>

                <!-- Payments -->
                <div class="col-md-4 mb-3">
                    <div class="card shadow text-center p-3">
                        <h5>💵 Payments</h5>
                        <h2 class="counter" data-target="{{ $paymentsCount }}">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Counter Animation Script -->
<script>
    const counters = document.querySelectorAll('.counter');
    counters.forEach(counter => {
        const updateCount = () => {
            const target = +counter.getAttribute('data-target');
            const count = +counter.innerText;
            const increment = target / 200; // adjust speed
            if(count < target) {
                counter.innerText = Math.ceil(count + increment);
                setTimeout(updateCount, 10);
            } else {
                counter.innerText = target;
            }
        }
        updateCount();
    });
</script>
</body>
</html>
