@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-10 px-4 sm:px-6 lg:px-8">
    <div class="max-w-6xl mx-auto">
        {{-- Welcome Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">
                👋 Welcome back, <span class="text-blue-600">{{ $student->name }}</span>
            </h1>
            <p class="text-gray-500 mt-1">Here’s a summary of your progress and activity.</p>
        </div>

        {{-- Stats Section --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-blue-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Courses</h3>
                        <p class="text-3xl font-bold text-blue-600 mt-2">{{ $totalCourses }}</p>
                    </div>
                    <i class="fa-solid fa-book text-blue-400 text-3xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-green-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Teachers</h3>
                        <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalTeachers }}</p>
                    </div>
                    <i class="fa-solid fa-user-tie text-green-400 text-3xl"></i>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-sm border-t-4 border-red-500 hover:shadow-md transition">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Total Payments</h3>
                        <p class="text-3xl font-bold text-red-600 mt-2">
                            {{ number_format($totalPayments, 0, ',', ' ') }} FCFA
                        </p>
                    </div>
                    <i class="fa-solid fa-wallet text-red-400 text-3xl"></i>
                </div>
            </div>
        </div>

        {{-- Enrolled Courses --}}
        <div class="bg-white mt-10 p-6 rounded-xl shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">📚 Enrolled Courses</h2>
                <span class="text-sm text-gray-500">Total: {{ $student->enrollments->count() }}</span>
            </div>

            @if($student->enrollments->count() > 0)
                <table class="min-w-full border divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Course Name</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Batch</th>
                            <th class="py-2 px-4 text-left text-sm font-semibold text-gray-600">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($student->enrollments as $enrollment)
                            <tr class="hover:bg-gray-50">
                                <td class="py-2 px-4 text-gray-700">
                                    {{ $enrollment->batch->course->name ?? 'N/A' }}
                                </td>
                                <td class="py-2 px-4 text-gray-700">
                                    {{ $enrollment->batch->name ?? 'N/A' }}
                                </td>
                                <td class="py-2 px-4">
                                    <span class="px-3 py-1 text-sm rounded-full 
                                        {{ $enrollment->status == 'active' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                        {{ ucfirst($enrollment->status ?? 'Pending') }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500 italic">You haven’t enrolled in any courses yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
