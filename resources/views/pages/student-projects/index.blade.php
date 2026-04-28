@extends('layouts.app')

@section('header_title', 'Student Project Management')

@section('content')
<div x-data="{ showProjectModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false, showDetailModal: false, showReviewModal: false }" class="max-w-7xl mx-auto">

    <div class="flex flex-wrap items-end gap-4 mb-8">
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Project</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search by title or name" class="w-full pl-10 pr-4 h-[42px] rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search by Date</label>
            <div class="relative"> 
                <input type="date" class="w-full px-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Course Types</label>
            <select class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm">
                <option value="">All Course Type</option>
                <option value="1">Little Koders</option>
                <option value="2">Junior Koders</option>
            </select>
        </div>
    </div>

    <div class="flex justify-between mb-8 gap-4">
        <div class="flex items-end">
            <p class="text-sm font-medium text-gray-500">Manage student projects and reviews.</p>
        </div>

        <div class="flex gap-4">
            
            <button @click="showProjectModal = true" class="px-6 py-2.5 h-[42px] min-w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm flex items-center justify-center">
                + Add Student Project
            </button>
        </div>
    </div>

    {{-- empty data --}}
    {{-- <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col items-center justify-center min-h-[500px] p-8">
        <div class="w-20 h-20 bg-brand-light-yellow rounded-full flex items-center justify-center mb-6 shadow-sm">
            <svg class="w-10 h-10 text-brand-yellow" fill="currentColor" viewBox="0 0 24 24">
                <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
        </div>

        <h2 class="text-xl font-semibold text-gray-900 mb-2">No student projects yet</h2>
        <p class="text-md text-gray-500 font-medium mb-8">No student project data available yet.</p>

        <button @click="showProjectModal = true" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            Add your first student project
        </button>
    </div> --}}

    {{-- student project table --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 bg-brand-light-blue">
                        <th class="py-3 px-6 text-center w-16">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Project Title</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Student Name</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Module</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Date</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Created By</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Review</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-6 text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </td>
                        <td class="py-3 px-4 text-sm font-bold text-gray-800">Website Anomali</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">John Doe</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">Website Development</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">10-12-2026</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                    <svg class="w-full h-full text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Rinda</span>
                            </div>
                        </td>
                        <td class="py-3 px-6">
                            <div class="flex items-center justify-center gap-3">
                                    {{-- <button @click="showReviewModal = true" class="group transition-colors" title="Edit Review">
                                        
                                        <svg class="w-5 h-5 text-green-500 group-hover:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                        </svg>

                                        <svg class="w-5 h-5 text-brand-pink hidden group-hover:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                        
                                    </button> --}}

                                    <button @click="showReviewModal = true" class="text-brand-yellow-active hover:text-brand-dark-yellow transition-colors" title="Add Review">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path></svg>
                                    </button>
                                </div>
                        </td>
                        <td class="py-3 px-6">
                            <div class="flex items-center justify-center gap-3">
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button @click="showProjectModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
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
    
    <div class="flex items-center justify-between text-sm text-gray-500 px-2">
        <div>
            Total 1 document
        </div>
        
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <span>Rows per page</span>
                <select class="border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-brand-pink bg-white">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>
            </div>
            <span>1 of 1</span>
            <div class="flex items-center gap-4">
                <button class="text-gray-300 cursor-not-allowed flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                    Previous
                </button>
                <button class="text-gray-500 hover:text-gray-800 transition-colors flex items-center gap-1">
                    Next
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- create & edit student project modal --}}
    <div x-show="showProjectModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showProjectModal = false" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showProjectModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Student Project Information</h2>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 @error('title') text-red-500 @else text-gray-800 @enderror">
                                Project Title
                            </label>
                            
                            <input type="text" name="title" value="{{ old('title') }}" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('title') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                            @error('title')
                                <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Student Name</label>
                            <select name="student_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition bg-white text-sm">
                                <option value="" disabled selected>Select Student</option>
                                <option value="1">John Doe</option>
                                <option value="2">Jane Smith</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Module</label>
                            <select name="module_id" class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition bg-white text-sm">
                                <option value="" disabled selected>Select Module</option>
                                <option value="1">2D Games with Roblox</option>
                                <option value="2">Javascript</option>
                                <option value="3">Python First</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Date</label>
                            <input type="date" name="date" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Description</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition"></textarea>
                        </div>
                    </div>
                    
                    {{-- upload file --}}
                    <div class="flex flex-col h-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">File Upload</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer hover:opacity-80 transition relative">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*,application/pdf">
                            <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Click for Upload File</h4>
                            <p class="text-xs font-medium text-gray-500">PDF, IMAGE, JPG, PNG, JPEG</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800 mt-5">Project URL</label>
                            <input type="url" name="project_url" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('project_url') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="showProjectModal = false" class="flex-1 py-3 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition">Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- create, edit & delete project review modal --}}
    <div x-show="showReviewModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showReviewModal = false" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showReviewModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Project Review</h2>

            <form action="#" method="POST" class="space-y-5">
                <div x-data="{ rating: 0, hover: 0 }">
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Rating</label>
                    <div class="flex items-center gap-1">
                        <template x-for="star in 5">
                            <button type="button" 
                                    @click="rating = star" 
                                    @mouseenter="hover = star" 
                                    @mouseleave="hover = 0"
                                    class="focus:outline-none transition-transform hover:scale-110">
                                <svg class="w-9 h-9 transition-colors" 
                                    :class="(hover || rating) >= star ? 'text-[#FFD700]' : 'text-gray-200'" 
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        </template>
                    </div>
                    <input type="hidden" name="rating" :value="rating">
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Review Content</label>
                    <textarea name="review_content" rows="5" placeholder="Write review here..." class="w-full px-4 py-3 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition"></textarea>
                </div>

                <div class="flex justify-baseline gap-2">
                    <input type="checkbox" id="approve" name="approve_review" class="w-5 h-5 text-brand-pink focus:ring-brand-pink border-gray-300 rounded cursor-pointer transition">
                    <label for="approve" class="text-sm font-semibold text-gray-900 cursor-pointer select-none">Approve Review</label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 mt-10 pt-5 border-t border-gray-100 items-center justify-center">
                    <div>
                        <button type="button" class="group flex gap-2 w-2/4 text-gray-400 hover:text-red-500 transition-colors">
                            <div>
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <span class="text-sm font-semibold">Delete Review</span>
                        </button>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" @click="showReviewModal = false" class="py-2.5 w-2/4 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition text-sm">Cancel</button>
                        <button type="submit" class="py-2.5 w-2/4 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-sm">Save</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    {{--delete confirm modal --}}
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Project?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this student project data? This action cannot be undone.</p>
            
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- student project & review modal --}}
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg p-8 md:p-10 w-full max-w-3xl shadow-2xl relative mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 text-gray-800 hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-3xl font-semibold text-brand-pink mb-8">Project Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-[1fr_1.5fr] gap-8 md:gap-12">
                <div class="w-full rounded-lg border border-gray-200 overflow-hidden bg-gray-50 aspect-[3/4] flex items-center justify-center">
                    <div class="w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjZTVlN2ViIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2Y5ZmFmYiIvPjxyZWN0IHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiNmOWZhZmIiLz48cmVjdCB4PSIxMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2U1ZTdlYiIvPjwvc3ZnPg==')] opacity-50"></div>
                </div>

                <div class="flex flex-col">
                    <div class="mb-6">
                        <span class="inline-block px-6 py-2.5 bg-brand-light-pink text-brand-pink font-semibold rounded-full text-lg">
                            Description
                        </span>
                    </div>

                    <p class="text-gray-800 text-sm leading-relaxed mb-4 flex-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at dapibus risus. Donec eu odio id risus laoreet vehicula nec quis massa. Phasellus dapibus turpis eget lacus pretium varius. Nulla at quam non augue dapibus ultricies.
                    </p>

                    <div class="flex items-center mt-auto pt-6">
                        <div class="flex-1 text-center border-r-2 border-gray-300">
                            <p class="text-brand-pink font-bold mb-2 text-lg">Start Date</p>
                            <p class="text-gray-900 font-medium text-lg">13 March 2026</p>
                        </div>
                        <div class="flex-1 text-center">
                            <p class="text-brand-pink font-bold mb-2 text-lg">End Date</p>
                            <p class="text-gray-900 font-medium text-lg">20 April 2026</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection