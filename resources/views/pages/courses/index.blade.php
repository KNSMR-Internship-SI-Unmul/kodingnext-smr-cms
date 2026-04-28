@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/dashboard" class="hover:text-brand-blue-hover transition-colors">Dashboard</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Courses</span>
    </nav>
@endsection

@section('content')
<div x-data="{ showCourseModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false, showDetailModal: false }" class="max-w-7xl mx-auto">

    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-brand-pink mb-1 tracking-tight">Courses</h1>
            <p class="text-sm font-medium text-gray-500">Manage courses.</p>
        </div>
        <button @click="showCourseModal = true" class="px-6 py-2.5 w-[180px] h-[42px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            + Add Course
        </button>
    </div>

    {{-- course table --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="h-12 border-b border-gray-100 bg-brand-light-blue">
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap w-16 text-center">No.</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Course Name</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap text-center">Created At</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap w-32">Action</th>
                    </tr>
                </thead>
                
                <tbody>
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-4 text-center font-semibold text-gray-900 text-sm">1</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">Little Koders</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button @click="showCourseModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button @click="showDeleteModal = true" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-4 text-center font-semibold text-gray-900 text-sm">2</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">Junior Koders</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = false" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button @click="showCourseModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button @click="showDeleteModal = true" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-4 text-center font-semibold text-gray-900 text-sm">3</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">RoboNext</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = false" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button @click="showCourseModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                <button @click="showDeleteModal = true" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- create & edit course modal --}}
    <div x-show="showCourseModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showCourseModal = false" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showCourseModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Course Information</h2>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Course Name</label>
                            <input type="text" name="name" class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Description</label>
                            <textarea type="text" name="description" rows="9" class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition"></textarea>
                        </div>
                    </div>

                    {{-- form upload file --}}
                    <div class="flex flex-col h-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Module Image</label>
                        
                        <div class="flex-1 min-h-[200px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer hover:opacity-80 transition relative">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Image</h4>
                            <p class="text-xs font-medium text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>

                        <div class="flex gap-3 mt-8 justify-end">
                            <button type="button" @click="showCourseModal = false" class="py-2.5 w-full bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition text-sm">Cancel</button>
                            <button type="submit" class="py-2.5 w-full bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-sm">Save</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{-- delete confirm modal --}}
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Course?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to delete this course?This action cannot be undone.</p>
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- course view modal --}}
    <div x-show="showDetailModal" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg w-[350px] max-w-md shadow-2xl relative overflow-hidden mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 z-20 text-gray-800 hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <div class="max-w h-[350px] bg-gray-50 relative flex items-center justify-center">                
                <img src="{{ asset('images/course-littlekoder.avif') }}" class="w-full h-full object-cover">
            </div>

            <div class="p-8 md:p-8 text-center flex flex-col items-center">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 tracking-tight">Little Koders</h2>
                
                <p class="text-sm leading-relaxed text-brand-pink font-medium">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at dapibus risus. Donec eu odio id risus laoreet vehicula nec quis massa. Phasellus dapibus turpis eget lacus pretium varius. Nulla at quam non augue dapibus ultricies.
                </p>
            </div>

        </div>
    </div>

</div>
@endsection