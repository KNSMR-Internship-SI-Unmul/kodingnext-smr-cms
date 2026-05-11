@extends('layouts.app')

@section('header_title', 'Student Project Management')

@section('content')
<div x-data="studentProjectManager({
        hasProjectErrors: {{ $errors->hasAny(['title', 'student_id', 'module_id', 'date', 'description', 'media']) ? 'true' : 'false' }},
        hasReviewErrors: {{ $errors->hasAny(['rating', 'review_content']) ? 'true' : 'false' }},
        storeRoute: '{{ route('student-projects.store') }}',
        storeReviewRoute: '{{ route('project-reviews.store') }}',
        bulkDestroyRoute: '{{ route('student-projects.bulkDestroy') }}',
        studentProjectIds: @js($studentProjects->pluck('id')),
        studentProjectCount: {{ $studentProjects->count() }},
        oldStudentProjectId: @js(old('student_project_id', '')),
        oldTitle: @js(old('title', '')),
        oldDescription: @js(old('description', '')),
        oldDate: @js(old('date', '')),
        oldMedia: @js(old('existing_media', '')),
        oldProjectUrl: @js(old('project_url', '')),
        oldIsPublished: @js(old('is_published', false)),
        oldModuleId: @js(old('module_id', '')),
        oldStudentId: @js(old('student_id', '')),
        oldReviewId: @js(old('review_id', '')),
        oldReviewStudentProjectId: @js(old('student_project_id', '')),
        oldReviewRating: @js(old('rating', 0)),
        oldReviewContent: @js(old('review_content', '')),
        oldReviewIsApproved: @js(old('is_approved', false))
    })"
    class="max-w-7xl mx-auto"
>

    <form method="GET" action="{{ route('student-projects.index') }}" class="flex flex-wrap items-end gap-4 mb-8 w-full">
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Project</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}"  placeholder="Search by title or name" class="w-full pl-10 pr-4 h-[42px] rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm" @input.debounce.500ms="$el.form.submit()">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search by Date</label>
            <div class="relative"> 
                <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm" @change="$el.form.submit()">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Course Types</label>
            <select name="course_type_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm" @change="$el.form.submit()">
                <option value="">All Course Type</option>
                @foreach ($courseTypes as $courseType)
                    <option value="{{ $courseType->id }}" {{ request('course_type_id') == $courseType->id ? 'selected' : '' }}>{{ $courseType->name }}</option>
                @endforeach
            </select>
        </div>

        @if(request('search') || request('date') || request('course_type_id'))
            <div class="flex gap-2">
                <a href="{{ route('student-projects.index') }}" class="px-4 py-2.5 h-[42px] bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition text-sm flex items-center justify-center" title="Clear Filters">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"></path></svg>
                </a>
            </div>
        @endif
    </form>

    <div class="flex justify-between mb-8 gap-4">
        <div class="flex items-end">
            <p class="text-md font-medium text-gray-500">Manage student projects and reviews.</p>
        </div>

        <div class="flex gap-4">
            <button type="button" x-show="selectedStudentProjects.length > 0" @click="openBulkDeleteModal()" x-transition class="px-4 py-2.5 h-[42px] gap-1 bg-red-100 hover:bg-red-500 text-red-600 hover:text-white font-semibold rounded-lg transition text-sm flex items-center justify-center" style="display: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>

            <button type="button" @click="resetModal()" class="px-6 py-2.5 h-[42px] min-w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm flex items-center justify-center">
                + Add Student Project
            </button>
        </div>
    </div>

    @if ($studentProjects->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No student project yet" 
                description="No student project data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </x-slot>

                <button type="button" @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first student project
                </button>
            </x-empty-state>
        </div>
    @else
        {{-- student project table --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-brand-light-blue">
                            <th class="py-3 px-6 text-center w-16">
                                <input type="checkbox" @click="toggleAll()" :checked="allSelected" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                            </th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Project Title</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Student Name</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Module</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Date</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Review</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Published</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($studentProjects as $studentProject)
                        <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                            <td class="py-3 px-6 text-center">
                                <input type="checkbox" value="{{ $studentProject->id }}" x-model="selectedStudentProjects" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                            </td>
                            <td class="py-3 px-4 text-sm font-bold text-gray-800">{{ $studentProject->title }}</td>
                            <td class="py-3 px-4 text-sm font-semibold text-gray-700 text-center">{{ $studentProject->student->name }}</td>
                            <td class="py-3 px-4 text-sm font-semibold text-gray-700 text-center">{{ $studentProject->module->name }}</td>
                            <td class="py-3 px-4 text-sm font-semibold text-gray-700 text-center">{{ $studentProject->date?->format('d/m/Y') ?? '-' }}</td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                <div class="flex items-center justify-center gap-3">
                                    @if($studentProject->projectReview)
                                        <button @click="openReviewModal({{ json_encode($studentProject) }})" class="transition-transform hover:scale-105" title="Edit Review">
                                            @if($studentProject->projectReview->is_approved)
                                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 border border-green-200">
                                                    Approved
                                                </span>
                                            @else
                                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-brand-light-yellow text-brand-yellow-active border border-brand-yellow/50">
                                                    Not Approved
                                                </span>
                                            @endif
                                        </button>
                                    @else
                                        <button @click="openReviewModal({{ json_encode($studentProject) }})" class="text-brand-yellow-active hover:text-brand-dark-yellow transition-transform hover:scale-105 " title="Add Review">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center whitespace-nowrap">
                                @if($studentProject->is_published)
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 border border-green-200">
                                        Published
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-700 border border-red-200">
                                        Not Published
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-6">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="/student-projects/{{ $studentProject->id }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    <button @click="openEditModal({{ json_encode($studentProject) }})" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button @click="openDeleteProjectModal({{ $studentProject->id }})" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    
        {{-- pagination --}}
        <div class="flex flex-col sm:flex-row items-center justify-between text-sm text-gray-500 px-2 mt-4">
            <div>
                Showing <span class="font-medium text-gray-900">{{ $studentProjects->firstItem() ?? 0 }}</span> to <span class="font-medium text-gray-900">{{ $studentProjects->lastItem() ?? 0 }}</span> of <span class="font-semibold text-brand-blue">{{ $studentProjects->total() }}</span> student projects
            </div>
            
            <div class="flex items-center gap-6 mt-4 sm:mt-0">
                <div class="flex items-center gap-2">
                    <span>Rows per page</span>
                    <select 
                        class="border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-brand-pink bg-white"
                        @change="
                            const url = new URL(window.location.href);
                            url.searchParams.set('per_page', $event.target.value);
                            url.searchParams.delete('page');
                            window.location.href = url.href;
                        "
                    >
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <span>Page {{ $studentProjects->currentPage() }} of {{ $studentProjects->lastPage() }}</span>
                
                <div class="flex items-center gap-4">
                    @if ($studentProjects->onFirstPage())
                        <span class="text-gray-300 cursor-not-allowed flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </span>
                    @else
                        <a href="{{ $studentProjects->previousPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </a>
                    @endif

                    @if ($studentProjects->hasMorePages())
                        <a href="{{ $studentProjects->nextPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
                            Next
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    @else
                        <span class="text-gray-300 cursor-not-allowed flex items-center gap-1">
                            Next
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endif

    {{-- create & edit student project modal --}}
    <div x-show="showStudentProjectModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Student Project Information</h2>

            <form :action="actionUrlProject" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editModeProject">
                <input type="hidden" name="student_project_id" x-model="studentProjectData.id">
                <input type="hidden" name="existing_media" x-model="studentProjectData.media">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Title</label>
                            <input type="text" name="title" x-model="studentProjectData.title" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('title') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Student Name</label>
                            <select name="student_id" x-model="studentProjectData.student_id" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('student_id') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                <option value="" disabled selected>Select Student...</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                                @endforeach
                            </select>
                            @error('student_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Module</label>
                            <select name="module_id" x-model="studentProjectData.module_id" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('module_id') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                <option value="" disabled selected>Select Module</option>
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            @error('module_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Date</label>
                            <input type="date" name="date" x-model="studentProjectData.date" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('date') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-1">Description</label>
                            <textarea name="description" rows="6" x-model="studentProjectData.description" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('description') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="Write module description here..."></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex flex-col h-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Student Project Media</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer transition relative hover:opacity-90">
                            <input type="file" 
                                name="media" 
                                accept="image/*,video/mp4,video/webm"
                                :required="!editModeProject"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        fileName = file.name;
                                        mediaPreview = URL.createObjectURL(file);
                                    } else {
                                        fileName = null;
                                        mediaPreview = null;
                                    }
                                ">
                            
                            <template x-if="!mediaPreview && !fileName">
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Media</h4>
                                    <p class="text-xs font-medium text-gray-500">JPG, PNG, JPEG, GIF, SVG up to 2MB</p>
                                </div>
                            </template>

                            <template x-if="mediaPreview || fileName">
                                <div class="flex flex-col items-center pointer-events-none text-center px-4 w-full h-full py-4 justify-center">
                                    <template x-if="isVideo(fileName || mediaPreview)">
                                        <div class="w-24 h-24 rounded-full overflow-hidden mb-3 shadow-md border-4 border-brand-pink bg-black">
                                            <video :src="mediaPreview" autoplay loop muted playsinline class="w-full h-full object-cover"></video>
                                        </div>
                                    </template>

                                    <template x-if="!isVideo(fileName || mediaPreview)">
                                        <img :src="mediaPreview" alt="Media Preview" class="w-24 h-24 rounded-full object-cover mb-3 shadow-md border-4 border-brand-pink">
                                    </template>

                                    <h4 class="font-semibold text-gray-900 mb-1" x-text="fileName ? 'Media Ready to Save' : 'Current Project Media'"></h4>
                                    <p class="text-xs font-normal text-gray-400 mt-2">(Click anywhere to change media)</p>
                                </div>
                            </template>
                        </div>
                        @error('media')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800 mt-5">Project URL</label>
                            <input type="url" name="project_url" x-model="studentProjectData.project_url" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('project_url') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                        </div>

                        <div class="flex items-center gap-2 mt-5">
                            <input type="checkbox" id="is_published" name="is_published" value="1" x-model="studentProjectData.is_published" class="w-5 h-5 text-brand-pink focus:ring-brand-pink border-gray-300 rounded cursor-pointer transition">
                            <label for="is_published" class="text-sm font-semibold text-gray-900 cursor-pointer select-none">Publish Project</label>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="closeEditModal()" class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-pink text-white hover:bg-brand-pink-hover font-semibold rounded-lg transition">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- create, edit & delete project review modal --}}
    <div x-show="showReviewModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="if(!showDeleteReviewModal) closeReviewModal()" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeReviewModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Project Review</h2>

            <form :action="actionUrlReview" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editModeReview">
                <input type="hidden" name="review_id" x-model="projectReviewData.id">
                <input type="hidden" name="student_project_id" x-model="projectReviewData.student_project_id">
                <div x-data="{ hover: 0 }">
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Rating</label>
                    <div class="flex items-center gap-1">
                        <template x-for="star in 5">
                            <button type="button" 
                                    @click="projectReviewData.rating = star" 
                                    @mouseenter="hover = star" 
                                    @mouseleave="hover = 0"
                                    class="focus:outline-none transition-transform hover:scale-110">
                                <svg class="w-9 h-9 transition-colors" 
                                    :class="(hover || projectReviewData.rating) >= star ? 'text-[#FFD700]' : 'text-gray-200'" 
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </button>
                        </template>
                    </div>
                    <input type="hidden" name="rating" x-model="projectReviewData.rating" >
                    @error('rating')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Review Content</label>
                    <textarea name="review_content" x-model="projectReviewData.review_content" rows="5" placeholder="Write review here..." class="w-full px-4 py-3 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('review_content') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror""></textarea>
                    @error('review_content')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-baseline gap-2">
                    <input type="checkbox" id="approve" name="is_approved" value="1" x-model="projectReviewData.is_approved" class="w-5 h-5 text-brand-pink focus:ring-brand-pink border-gray-300 rounded cursor-pointer transition">
                    <label for="approve" class="text-sm font-semibold text-gray-900 cursor-pointer select-none">Approve Review</label>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 mt-10 pt-5 border-t border-gray-100 items-center justify-center">
                    <div>
                        <template x-if="editModeReview">
                            <button type="button" @click="showDeleteReviewModal = true" class="group flex gap-2 w-2/4 text-gray-400 hover:text-red-500 transition-colors">
                                <div>
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                <span class="text-sm font-semibold">Delete Review</span>
                            </button>
                        </template>
                    </div>

                    <div class="flex gap-3">
                        <button type="button" @click="closeReviewModal()" class="py-2.5 w-2/4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition text-sm">Cancel</button>
                        <button type="submit" class="py-2.5 w-2/4 bg-brand-pink text-white hover:bg-brand-pink-hover font-semibold rounded-lg transition text-sm">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- delete confirm modal for student project --}}
    <div x-show="showDeleteProjectModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteProjectModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">
                <span x-show="deleteMode === 'single'">Delete Student Project?</span>
                <span x-show="deleteMode === 'bulk'">Delete <span x-text="studentProjectData.length"></span> Student Project?</span>
            </h3>
            
            <p class="text-sm text-gray-500 mb-6 font-medium" 
                x-text="deleteMode === 'single' ? 'Are you sure you want to remove this student project data? This action cannot be undone.' : 'Are you sure you want to remove all selected data? This action cannot be undone.'">
            </p>

            <div class="flex gap-3">
                <button @click="showDeleteProjectModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                
                <form :action="actionUrlProject" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <template x-if="deleteMode === 'bulk'">
                        <template x-for="id in selectedStudentProjects" :key="id">
                            <input type="hidden" name="ids[]" :value="id">
                        </template>
                    </template>

                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition" 
                            x-text="deleteMode === 'single' ? 'Yes, delete' : 'Yes, delete all'">
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- delete confirm modal for project review --}}
    <div x-show="showDeleteReviewModal" style="display: none;" class="fixed inset-0 z-[60] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeDeleteReviewModal()" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Project Review?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to delete this review? This action cannot be undone.</p>
            <div class="flex gap-3">
                <button type="button" @click="closeDeleteReviewModal()" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form :action="actionUrlReview" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- toast notification --}}
    @if(session('success') || session('delete'))
        <div class="fixed bottom-10 right-10 z-50 flex flex-col gap-3">
            @if(session('success'))
                <x-toast type="success" message="{{ session('success') }}" />
            @endif

            @if(session('delete'))
                <x-toast type="delete" message="{{ session('delete') }}" />
            @endif
        </div>
    @endif

</class=>
@endsection