@extends('layouts.admin')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500 text-sm">Total Students</h3>
            <p class="text-2xl font-bold mt-1 text-blue-600">{{ $totalStudents }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500 text-sm">Total Courses</h3>
            <p class="text-2xl font-bold mt-1 text-green-600">{{ $totalCourses }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500 text-sm">Total Batches</h3>
            <p class="text-2xl font-bold mt-1 text-purple-600">{{ $totalBatches }}</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-gray-500 text-sm">Total Payments</h3>
            <p class="text-2xl font-bold mt-1 text-red-600">{{ number_format($totalPayments, 0, ',', ' ') }} FCFA</p>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Enrollments by Course</h2>
            <canvas id="enrollmentsChart"></canvas>
        </div>
        <div class="bg-white p-6 rounded shadow">
            <h2 class="text-lg font-semibold mb-4">Monthly Payments</h2>
            <canvas id="paymentsChart"></canvas>
        </div>
    </div>

    <script>
        const enrollmentsData = @json($enrollmentsByCourse);
        const courseLabels = Object.keys(enrollmentsData);
        const courseCounts = Object.values(enrollmentsData);

        new Chart(document.getElementById('enrollmentsChart'), {
            type: 'bar',
            data: {
                labels: courseLabels,
                datasets: [{
                    label: 'Enrollments',
                    data: courseCounts,
                    backgroundColor: '#3b82f6'
                }]
            }
        });

        const monthlyPayments = @json($monthlyPayments);
        const months = Object.keys(monthlyPayments);
        const payments = Object.values(monthlyPayments);

        new Chart(document.getElementById('paymentsChart'), {
            type: 'line',
            data: {
                labels: months,
                datasets: [{
                    label: 'Payments (FCFA)',
                    data: payments,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.2)',
                    fill: true,
                }]
            }
        });
    </script>
@endsection
