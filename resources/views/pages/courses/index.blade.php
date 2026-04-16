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
        <button @click="showCourseModal = true" class="px-6 py-2.5 w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            + Add Course
        </button>
    </div>

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
                    {{-- TODO Backend: Lakukan perulangan (foreach) data $roles di sini. 
                    Untuk warna selang-seling, gunakan $loop->even dan $loop->odd dari Laravel --}}
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-4 text-center font-bold text-gray-900 text-sm">1</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">Little Koders</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
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
                        <td class="py-3 px-4 text-center font-bold text-gray-900 text-sm">2</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">Junior Koders</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
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
                        <td class="py-3 px-4 text-center font-bold text-gray-900 text-sm">3</td>
                        <td class="py-3 px-4 font-bold text-gray-900 text-sm">RoboNext</td>
                        <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">14 Mar 2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
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

    <div x-show="showCourseModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showCourseModal = false" class="bg-white rounded-lg p-8 w-full max-w-lg shadow-2xl relative overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showCourseModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Course Information</h2>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-800">Course Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-2 text-gray-800">Course Description</label>
                    <textarea type="text" name="description" rows="4" class="w-full px-4 py-2.5 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition"></textarea>
                </div>

                <div class="flex gap-2 pt-2">
                    <button type="button" @click="showCourseModal = false" class="flex-1 py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition text-sm">Cancel</button>
                    <button type="submit" class="flex-1 py-2.5 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-sm">Save</button>
                </div>
            </form>
        </div>
    </div>

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

    <div x-show="showDetailModal" style="display:none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg p-8 w-full max-w-lg shadow-2xl relative overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-4">Course Details</h2>

            <p class="text-sm text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        </div>
    </div>

</div>
@endsection