@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/student-projects" class="hover:text-brand-blue-hover transition-colors">Students</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Student Project Details</span>
    </nav>
@endsection

@section('content')
<div x-data="{
        showStudentModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false,
    }"
    class="max-w-7xl mx-auto"
>

    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-black mb-1 tracking-tight">Student Project Details</h1>
            <p class="text-sm font-medium text-gray-500">Complete student project information.</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/student-projects" class="flex items-center text-brand-pink hover:text-brand-blue-hover transition-colors font-semibold text-sm group">
                <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </a>
            <button @click="showStudentModal = true" class="flex items-center justify-center px-6 py-2.5 w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </button>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row bg-[#FDF0F5] rounded-3xl overflow-hidden mb-12 shadow-sm border border-[#FADCE6]">
        
        {{-- Left Side: Image & Link (Placeholder for Video/Image) --}}
        <div class="lg:w-1/2 relative bg-gray-200 min-h-[300px] lg:min-h-full">
            {{-- Ganti dengan tag img jika ada gambar --}}
            {{-- <img src="{{ asset('storage/' . $studentProject->image) }}" alt="Project Image" class="w-full h-full object-cover"> --}}
            
            {{-- Link Project Button --}}
            <div class="absolute bottom-6 left-6 right-6">
                <a href="{{ $studentProject->project_link ?? '#' }}" target="_blank" class="block w-full bg-[#D46C9A] hover:bg-[#C25886] transition-colors rounded-xl p-4 shadow-md group">
                    <p class="text-white/90 text-sm font-semibold mb-1">Link Project</p>
                    <p class="text-white text-xs truncate group-hover:underline">
                        {{ $studentProject->project_link ?? 'https://www.figma.com/design/hnaki9uEJr8BZytIOH8M4' }}
                    </p>
                </a>
            </div>
        </div>

        {{-- Right Side: Project Info --}}
        <div class="lg:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-3xl font-bold text-black mb-6 leading-tight">
                {{ $studentProject->title ?? 'Game Labirin by Ben' }}
            </h2>
            
            <div class="flex items-center gap-6 mb-8">
                <div class="flex items-center gap-2 text-[#D46C9A]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-semibold text-lg">
                        {{ $studentProject->created_at ? $studentProject->created_at->format('d F Y') : '30 April 2026' }}
                    </span>
                </div>
                
                {{-- Kategori/Course Type Tag --}}
                <span class="px-6 py-2 bg-[#F3CEDB] text-[#D46C9A] font-semibold rounded-full text-sm">
                    {{ $studentProject->category ?? 'Little Koders' }}
                </span>
            </div>

            <p class="text-black font-medium leading-relaxed">
                {{ $studentProject->description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at dapibus risus. Donec eu odio id risus laoreet vehicula nec quis massa. Phasellus dapibus turpis eget lacus pretium varius. Nulla at quam non augue dapibus ultricies.' }}
            </p>
        </div>
    </div>

    {{-- Review Section --}}
    <div>
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-3xl font-bold text-[#D46C9A]">Project Review</h3>
            
            {{-- Star Rating (Static example for 3 out of 5 stars) --}}
            {{-- Nanti bisa dibuat dinamis menggunakan loop foreach atau for berdasarkan nilai di database --}}
            <div class="flex gap-2 text-[#F4C542]">
                <svg class="w-8 h-8 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-8 h-8 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                <svg class="w-8 h-8 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                {{-- Empty Stars --}}
                <svg class="w-8 h-8 text-[#F4C542]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                <svg class="w-8 h-8 text-[#F4C542]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
            </div>
        </div>

        <p class="text-black text-xl font-medium leading-relaxed max-w-4xl">
            {{ $studentProject->review ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at dapibus risus. Donec eu odio id risus laoreet vehicula nec quis massa. Phasellus dapibus turpis eget lacus pretium varius. Nulla at quam non augue dapibus ultricies.' }}
        </p>
    </div>


</div>

@endsection