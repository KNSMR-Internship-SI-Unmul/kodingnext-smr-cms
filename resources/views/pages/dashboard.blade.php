@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-9">
        
        <div class="bg-brand-pink rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-pink-hover rounded-full flex items-center justify-center text-brand-pink flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Employees</p>
                <p class="text-3xl font-extrabold leading-none">9</p>
            </div>
        </div>

        <div class="bg-brand-blue rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-blue-hover rounded-full flex items-center justify-center text-brand-blue flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Promotions</p>
                <p class="text-3xl font-extrabold leading-none">3</p>
            </div>
        </div>

        <div class="bg-brand-pink rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-pink-hover rounded-full flex items-center justify-center text-brand-pink flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Student Projects</p>
                <p class="text-3xl font-extrabold leading-none">1</p>
            </div>
        </div>

        <div class="bg-brand-blue rounded-2xl p-6 flex items-center gap-5 shadow-md transform hover:-translate-y-1 transition-transform">
            <div class="w-14 h-14 bg-brand-light-blue-hover rounded-full flex items-center justify-center text-brand-blue flex-shrink-0">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    <text x="12" y="16" text-anchor="middle" font-size="7" font-family="sans-serif" font-weight="bold" fill="currentColor">11</text>
                </svg>
            </div>
            <div class="text-white">
                <p class="text-sm font-medium text-white/90 mb-0.5">Events</p>
                <p class="text-3xl font-extrabold leading-none">5</p>
            </div>
        </div>
        
    </div>

    {{-- courses overview --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-brand-pink tracking-tight">Courses Overview</h2>
        <a href="/dashboard/courses" class="px-6 py-2.5 h-[42px] bg-brand-white hover:bg-brand-pink text-brand-pink hover:text-white border border-brand-pink font-semibold rounded-lg transition-colors text-sm justify-center flex">
            Manage Courses
        </a>
    </div>

    <div class="flex flex-col gap-5">
        
        {{-- course little koders --}}
        <div class="bg-brand-light-pink rounded-xl p-4 flex flex-col sm:flex-row items-center gap-6 relative pr-16 border border-brand-pink/10">
            <div class="w-32 h-32 bg-white rounded-xl shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/course-littlekoder.avif') }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 py-2">
                <h3 class="text-2xl font-bold text-brand-pink mb-1.5">Little Koders</h3>
                <p class="text-sm text-brand-pink leading-[1.7] max-w-4xl">
                    Kursus coding ini dirancang untuk mengajarkan siswa sejak usia 4-8 tentang pemrograman dan meningkatkan pemikiran logis serta keterampilan matematika mereka.
                </p>
            </div>
            <button class="absolute bottom-4 right-4 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-700 shadow-sm hover:text-brand-pink hover:bg-gray-50 transition-all border border-gray-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </div>

        {{-- course junior koders --}}
        <div class="bg-brand-light-blue rounded-xl p-4 flex flex-col sm:flex-row items-center gap-6 relative pr-16 border border-brand-blue/10">
            <div class="w-32 h-32 bg-white rounded-xl shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/course-juniorkoder.avif') }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 py-2">
                <h3 class="text-2xl font-bold text-brand-blue mb-1.5">Junior Koders</h3>
                <p class="text-sm text-brand-blue leading-[1.7] max-w-4xl">
                    Kursus coding ini diperuntukkan bagi siswa berusia 8 hingga 16 tahun. Program ini menawarkan kursus pemula dalam pemrograman blok, seperti Game 2D dan Pengembangan Aplikasi Mobile, dan kursus lanjutan dalam pemrograman berbasis teks, seperti Python, JavaScript, dan Smart Home IoT.
                </p>
            </div>
            <button class="absolute bottom-4 right-4 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-700 shadow-sm hover:text-brand-blue hover:bg-gray-50 transition-all border border-gray-100">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </div>

        <div class="bg-brand-light-purple rounded-xl p-4 flex flex-col sm:flex-row items-center gap-6 relative pr-16 border border-brand-purple/10">
            <div class="w-32 h-32 bg-white rounded-xl shadow-sm flex-shrink-0 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('images/course-robonext.avif') }}" class="w-full h-full object-cover">
            </div>
            <div class="flex-1 py-2">
                <h3 class="text-2xl font-bold text-brand-purple/75 mb-1.5">RoboNext</h3>
                <p class="text-sm text-brand-purple/75 leading-[1.7] max-w-4xl">
                    Kursus  robotika dari Koding Next ini dirancang untuk memperkenalkan teknologi melalui pengalaman langsung. Siswa tidak hanya belajar coding dan merakit robot, tetapi juga memahami cara teknologi bekerja untuk menyelesaikan masalah dunia nyata.
                </p>
            </div>
            <button class="absolute bottom-4 right-4 w-9 h-9 bg-white rounded-full flex items-center justify-center text-gray-700 shadow-sm hover:text-brand-purple/75 hover:bg-gray-50 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
            </button>
        </div>

    </div>

</div>
@endsection