<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Student Management System</title>

    {{-- Tailwind or Bootstrap --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f3f4f6;
        }
        .sidebar {
            width: 250px;
            background-color: #1f2937;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            padding: 20px;
        }
        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 6px;
            transition: background 0.2s;
        }
        .sidebar a:hover {
            background-color: #374151;
            color: #fff;
        }
        .active-link {
            background-color: #2563eb;
            color: white !important;
        }
        .main-content {
            margin-left: 260px;
            padding: 30px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h2 class="text-2xl font-bold mb-6">📚 Admin Panel</h2>
        <a href="{{ route('admin.dashboard') }}" class="active-link"><i class="fa-solid fa-house"></i> Dashboard</a>
        <a href="{{ route('students.index') }}"><i class="fa-solid fa-user-graduate"></i> Students</a>
        <a href="{{ route('courses.index') }}"><i class="fa-solid fa-book"></i> Courses</a>
        <a href="{{ route('batch.index') }}"><i class="fa-solid fa-box"></i> Batches</a>
        <a href="{{ route('enrollments.index') }}"><i class="fa-solid fa-clipboard-list"></i> Enrollments</a>
        <a href="{{ route('payments.index') }}"><i class="fa-solid fa-credit-card"></i> Payments</a>
        <hr class="my-4 border-gray-700">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-red-500 hover:text-red-700">
                Logout
            </button>
        </form>

    </div>

    {{-- Main Content --}}
    <div class="main-content">
        <div class="topbar">
            <h1 class="text-xl font-semibold text-gray-800">Welcome, Super Admin</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="text-red-500 hover:text-red-700">
                    Logout
                </button>
            </form>

        </div>

        <div class="mt-6">
            @yield('content')
        </div>
    </div>

</body>
</html>
