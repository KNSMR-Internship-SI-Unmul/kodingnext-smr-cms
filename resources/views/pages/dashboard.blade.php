@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    {{-- statistic information --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-9">
        
        <div class="bg-brand-pink rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-pink-hover rounded-full flex items-center justify-center text-brand-pink flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Employees</p>
                <p class="text-3xl font-extrabold leading-none">{{ $totalEmployees }}</p>
            </div>
        </div>

        <div class="bg-brand-blue rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-blue-hover rounded-full flex items-center justify-center text-brand-blue flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Promotions</p>
                <p class="text-3xl font-extrabold leading-none">{{ $totalPromotions }}</p>
            </div>
        </div>

        <div class="bg-brand-pink rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-pink-hover rounded-full flex items-center justify-center text-brand-pink flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    <text x="12" y="16" text-anchor="middle" font-size="7" font-family="sans-serif" font-weight="bold" fill="currentColor">11</text>
                </svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Events</p>
                <p class="text-3xl font-extrabold leading-none">{{ $totalEvents }}</p>
            </div>
        </div>

        <div class="bg-brand-blue rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-blue-hover rounded-full flex items-center justify-center text-brand-blue flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Student Projects</p>
                <p class="text-3xl font-extrabold leading-none">{{ $totalStudentProjects }}</p>
            </div>
        </div>
        
    </div>

    {{-- courses overview --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-brand-pink tracking-tight">Courses Overview</h2>
        <a href="/dashboard/courses" class="px-6 py-2.5 h-[42px] gap-2 bg-brand-white hover:bg-brand-pink text-brand-pink hover:text-white border border-brand-pink font-semibold rounded-lg transition-colors text-sm justify-center flex">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 7.5-9-5.25L3 7.5m18 0-9 5.25m9-5.25v9l-9 5.25M3 7.5l9 5.25M3 7.5v9l9 5.25m0-9v9"></path></svg>
            Manage Courses
        </a>
    </div>

    <div class="flex flex-col gap-5">
        @forelse($courseTypes as $courseType)
            @php
                $courseName = strtolower($courseType->name);
                
                if (str_contains($courseName, 'junior')) {
                    $colorClass = 'brand-blue';
                    $bgClass = 'brand-light-blue';
                    $defaultImage = 'images/course-juniorkoder.avif';
                } elseif (str_contains($courseName, 'little')) {
                    $colorClass = 'brand-pink';
                    $bgClass = 'brand-light-pink';
                    $defaultImage = 'images/course-littlekoder.avif';
                } elseif (str_contains($courseName, 'robo')) {
                    $colorClass = 'brand-purple/75'; 
                    $bgClass = 'brand-light-purple'; 
                    $defaultImage = 'images/course-robonext.avif';
                } else {
                    $colorClass = 'gray-600'; 
                    $bgClass = 'gray-100';
                }
                $imagePath = $courseType->image ? asset('storage/' . $courseType->image) : asset($defaultImage);
                $description = $courseType->description ?? 'Deskripsi untuk ' . $courseType->name . ' belum tersedia.';
            @endphp

            <div class="bg-{{ $bgClass }} rounded-xl p-4 flex flex-col sm:flex-row items-center gap-6 relative pr-16 border border-{{ $colorClass }}/10">
                <div class="w-32 h-32 bg-white rounded-xl shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                    <img src="{{ $imagePath }}" class="w-full h-full object-cover" alt="{{ $courseType->name }}">
                </div>
                <div class="flex-1 py-2">
                    <h3 class="text-2xl font-bold text-{{ $colorClass }} mb-1.5">
                        {{ $courseType->name }}
                    </h3>
                    <p class="text-sm text-{{ $colorClass }} leading-[1.7] max-w-4xl">
                        {{ $description }}
                    </p>
                </div>
                <a href="/dashboard/courses" class="absolute bottom-4 right-4 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-700 shadow-sm hover:text-{{ $colorClass }} hover:bg-gray-50 transition-all border border-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                </a>
            </div>

        @empty
            <div class="bg-gray-50 rounded-xl p-8 flex flex-col items-center justify-center gap-3 border border-dashed border-gray-200">
                <span class="text-gray-500 font-bold text-sm">No course types available.</span>
            </div>
        @endforelse
    </div>

</div>
@endsection