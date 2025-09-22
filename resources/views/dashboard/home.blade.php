@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">School Management Dashboard</h2>

    <div class="row">
        <!-- Students -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>👨‍🎓 Students</h5>
                <h2 class="counter" data-target="{{ $stats['students'] }}">0</h2>
            </div>
        </div>

        <!-- Teachers -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>👩‍🏫 Teachers</h5>
                <h2 class="counter" data-target="{{ $stats['teachers'] }}">0</h2>
            </div>
        </div>

        <!-- Courses -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>📘 Courses</h5>
                <h2 class="counter" data-target="{{ $stats['courses'] }}">0</h2>
            </div>
        </div>

        <!-- Batches -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>📅 Batches</h5>
                <h2 class="counter" data-target="{{ $stats['batches'] }}">0</h2>
            </div>
        </div>

        <!-- Enrollments -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>📝 Enrollments</h5>
                <h2 class="counter" data-target="{{ $stats['enrollments'] }}">0</h2>
            </div>
        </div>

        <!-- Payments -->
        <div class="col-md-4 mb-3">
            <div class="card shadow text-center p-3">
                <h5>💵 Payments</h5>
                <h2 class="counter" data-target="{{ $stats['payments'] }}">0</h2>
            </div>
        </div>
    </div>
</div>

<!-- Counter Script -->
<script>
    document.querySelectorAll('.counter').forEach(counter => {
        counter.innerText = "0";
        const updateCounter = () => {
            const target = +counter.getAttribute("data-target");
            const current = +counter.innerText;
            const increment = target / 100;

            if (current < target) {
                counter.innerText = ${Math.ceil(current + increment)};
                setTimeout(updateCounter, 30);
            } else {
                counter.innerText = target;
            }
        };
        updateCounter();
    });
</script>
@endsection