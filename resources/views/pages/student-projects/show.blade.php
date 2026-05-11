@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/student-projects" class="hover:text-brand-blue-hover transition-colors">Students</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Student Project Details</span>
    </nav>
@endsection

@section('content')
<div x-data="studentProjectManager({
        hasProjectErrors: {{ $errors->hasAny(['title', 'student_id', 'module_id', 'date', 'description', 'media']) ? 'true' : 'false' }},
        storeRoute: '{{ route('student-projects.store') }}',
        oldStudentProjectId: @js(old('student_project_id', $studentProject->id)),
        oldTitle: @js(old('title', $studentProject->title)),
        oldDescription: @js(old('description', $studentProject->description)),
        oldDate: @js(old('date', $studentProject->date)),
        oldMedia: @js(old('existing_media', $studentProject->media)),
        oldProjectUrl: @js(old('project_url', $studentProject->project_url)),
        oldIsPublished: @js(old('is_published', false)),
        oldModuleId: @js(old('module_id', $studentProject->module_id)),
        oldStudentId: @js(old('student_id', $studentProject->student_id))
    })"
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
            <button @click="openEditModal({{ json_encode($studentProject) }})" class="flex items-center justify-center px-6 py-2.5 w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </button>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row bg-brand-light-pink rounded-3xl overflow-hidden mb-12 shadow-sm border border-brand-pink/10">
        <div class="lg:w-1/2 relative bg-gray-200 min-h-80 lg:min-h-full">
            @php
                $mediaExt = strtolower(pathinfo($studentProject->media, PATHINFO_EXTENSION));
                $isVideo = in_array($mediaExt, ['mp4', 'webm', 'ogg']);
            @endphp

            @if($isVideo)
                <video autoplay muted loop playsinline class="w-full h-full object-cover">
                    <source src="{{ asset('storage/' . $studentProject->media) }}" type="video/{{ $mediaExt === 'ogg' ? 'ogg' : $mediaExt }}">
                    Your browser does not support the video tag.
                </video>
            @else
                <img src="{{ asset('storage/' . $studentProject->media) }}" alt="{{ $studentProject->student->name }}'s Project Media" class="w-full h-full object-cover">
            @endif

            @if($studentProject->project_url)
                <div class="absolute bottom-6 left-6 z-20">
                    <a href="{{ $studentProject->project_url }}" target="_blank" class="group flex items-center bg-brand-pink text-white rounded-full shadow-lg h-12 transition-all duration-300 ease-in-out overflow-hidden hover:pr-6">
                        
                        <div class="w-12 h-12 flex shrink-0 items-center justify-center">
                            <svg class="w-5 h-5 text-white transform -rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                        </div>

                        <div class="flex flex-col justify-center max-w-0 group-hover:max-w-[200px] transition-all duration-300 ease-in-out opacity-0 group-hover:opacity-100 whitespace-nowrap overflow-hidden">
                            <span class="text-xs font-bold leading-tight mb-0.5">Link Project</span>
                            <span class="text-[10px] font-medium opacity-90 truncate w-full">{{ str_replace(['http://', 'https://'], '', $studentProject->project_url) }}</span>
                        </div>
                    </a>
                </div>
            @endif
        </div>

        <div class="lg:w-1/2 p-9 flex flex-col justify-center">
            <h2 class="text-3xl font-semibold text-black mb-5 leading-tight">
                {{ $studentProject->title }} by {{ $studentProject->student->name }}
            </h2>
            
            <div class="flex items-center gap-6 mb-5">
                <div class="flex items-center gap-2 text-brand-pink">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span class="font-semibold text-md">
                        {{ $studentProject->date?->format('d/m/Y') ?? '-' }}
                    </span>
                </div>
                
                <span class="px-6 py-2 bg-brand-light-pink-active/75 text-brand-pink font-semibold rounded-full text-sm">
                    {{ $studentProject->module->name }}
                </span>
            </div>

            <p class="text-black text-sm font-medium leading-relaxed">
                {{ $studentProject->description }}
            </p>
        </div>
    </div>

    @if($studentProject->projectReview)
        <div>
            <div class="flex justify-between items-center mb-5">
                <div class="flex items-center gap-4">
                    <h3 class="text-3xl font-bold text-brand-pink">Project Review</h3>
                    
                    @if($studentProject->projectReview->is_approved)
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200 mt-1">Approved</span>
                    @else
                        <span class="px-3 py-1 rounded-full text-xs font-bold bg-brand-light-yellow text-brand-yellow-active border border-brand-yellow/50 mt-1">Not Approved</span>
                    @endif
                </div>
                
                <div class="flex gap-2 text-brand-yellow">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= $studentProject->projectReview->rating)
                            <svg class="w-8 h-8 drop-shadow-sm" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @else
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path></svg>
                        @endif
                    @endfor
                </div>
            </div>

            <p class="text-black text-sm font-medium leading-relaxed">
                {{ $studentProject->projectReview->review_content }}
            </p>
        </div>
    @else
        <div class="mt-8 p-8 bg-gray-50 rounded-2xl border border-dashed border-gray-200 text-center">
            <h3 class="text-xl font-bold text-gray-500 mb-2">No review yet</h3>
            <p class="text-sm text-gray-500 font-medium">This student project hasn't received a review.</p>
        </div>
    @endif
    
    {{-- edit student project modal --}}
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
    
    {{-- toast notification --}}
    @if(session('success'))
        <div class="fixed bottom-10 right-10 z-50 flex flex-col gap-3">
            <x-toast type="success" message="{{ session('success') }}" />
        </div>
    @endif

</div>
@endsection