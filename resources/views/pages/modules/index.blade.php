@extends('layouts.app')

@section('header_title', 'Module Management')

@section('content')
<div x-data="{
        showModuleModal: {{ $errors->any() ? 'true' : 'false' }}, 
        juniorKoderId: {{ $courseTypes->where('name', 'Junior Koders')->first()->id ?? 'null' }},
        showDeleteModal: false,
        editMode: {{ old('module_id') ? 'true' : 'false' }},
        actionUrl: '{{ route('modules.store') }}',
        imagePreview: @js(old('existing_image') ? '/storage/' . old('existing_image') : null),

        moduleData: {
            id: @js(old('module_id', '')),
            name: @js(old('name', '')),
            description: @js(old('description', '')),
            age_range: @js(old('age_range', '')),
            duration_per_session: @js(old('duration_per_session', '')),
            category: @js(old('category', '')),
            course_type_id: @js(old('course_type_id', '')),
            image: @js(old('existing_image', '')),
        },

        openEditModal(module) {
            this.editMode = true;
            this.moduleData = { ...module, image: module.image, category: module.category || '' };
            this.actionUrl = `/modules/${module.id}`;
            this.imagePreview = module.image ? `/storage/${module.image}` : null;
            this.showModuleModal = true;
        },

        openDeleteModal(moduleId) {
            this.actionUrl = `/modules/${moduleId}`;
            this.showDeleteModal = true;
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showModuleModal = false;
            @endif
        },

        resetModal() {
            this.editMode = false;
            this.actionUrl = '{{ route('modules.store') }}';
            this.moduleData = { id: '', name: '', description: '', age_range: '', duration_per_session: '', category: '', course_type_id: '', image: '' };
            this.imagePreview = null;
            this.showModuleModal = true;
        },
    }" 
    class="max-w-7xl mx-auto"
>
    <form method="GET" action="{{ route('modules.index') }}" class="flex flex-wrap items-end gap-4 mb-9">
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Module</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search module by name" class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm" @input.debounce.500ms="$el.form.submit()">
            </div>
        </div>

        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Course Types</label>
            <select name="course_type_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm" @change="$el.form.submit()">
                <option value="">All Course Type</option>
                @foreach ($courseTypes as $courseType)
                    <option value="{{ $courseType->id }}" {{ request('course_type_id') == $courseType->id ? 'selected' : '' }}>{{ $courseType->name }}</option>
                @endforeach
            </select>
        </div>

        @if(request('search') || request('course_type_id'))
            <div class="flex gap-2">
                <a href="{{ route('modules.index') }}" class="px-4 py-2.5 h-[42px] bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition text-sm flex items-center justify-center" title="Clear Filters">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"></path></svg>
                </a>
            </div>
        @endif
        
        <div>
            <button type="button" @click="resetModal()" class="px-8 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm">
                + Add Module
            </button>
        </div>
    </form>

    @if ($modules->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No modules yet" 
                description="No module data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first module
                </button>
            </x-empty-state>
        </div>
    @else
        {{-- module cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-9">
            @foreach ($modules as $module)
                @php
                    $bgColors = [
                        1 => 'bg-brand-light-pink',
                        2 => 'bg-brand-light-blue', 
                        3 => 'bg-brand-light-purple',
                    ];
                    $textColors = [
                        1 => 'text-brand-pink',
                        2 => 'text-brand-blue',
                        3 => 'text-brand-purple/75',
                    ];
                    $borderColors = [
                        1 => 'border-brand-pink',
                        2 => 'border-brand-blue',
                        3 => 'border-brand-purple/75',
                    ];
                    $bgColor = $bgColors[$module->course_type_id];
                    $textColor = $textColors[$module->course_type_id];
                    $borderColor = $borderColors[$module->course_type_id];
                @endphp
                <div class="{{ $bgColor }} rounded-lg p-4 shadow-sm hover:shadow-md flex flex-col h-full relative group transform transition-all hover:-translate-y-1">
                    <div class="absolute top-3 right-3 z-20" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" class="{{ $textColor }} hover:text-brand-pink-hover focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-pink/10">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </button>
                        
                        <div 
                            x-show="openDropdown" 
                            @click.away="openDropdown = false"
                            style="display: none;"
                            class="absolute right-0 mt-1 w-36 bg-white rounded-xl shadow-xl border border-gray-100 z-20 overflow-hidden"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                        >
                            <button @click="openDropdown = false; openEditModal({{ json_encode($module) }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-pink flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Edit
                            </button>
                            <button @click="openDropdown = false; openDeleteModal({{ $module->id }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors border-t border-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex justify-between items-center px-3 pt-5 pb-3">
                        <div class="flex-1 min-h-16">
                            <h3 class="font-extrabold {{ $textColor }} text-xl leading-tight mb-1">{{ $module->name }}</h3>
                            
                            <div class="flex justify-between">
                                <p class="text-sm text-gray-500">{{ $module->courseType->name }}</p>
                                
                                @if($module->category)
                                    <span class="inline-block px-2.5 py-1 mt-2 border {{ $borderColor }} {{ $textColor }} text-xs font-semibold rounded-md w-fit">
                                        {{ $module->category }}
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($module->image)
                        <div class="flex-shrink-0 relative z-10">
                            <img src="{{ asset('storage/' . $module->image) }}" alt="{{ $module->name }} Icon" class="w-[106px] h-[106px] object-contain drop-shadow-sm">
                        </div>
                        @endif
                    </div>
                    
                    <div class="bg-white rounded-lg p-5 flex-1 flex flex-col {{ $borderColor }} border shadow-sm relative z-0">
                        <p class="text-xs text-gray-800 leading-relaxed mb-4 flex-1">{{ $module->description }}</p>
                        
                        <div class="flex items-center justify-between border-t border-gray-100 pt-3">
                            <div>
                                <p class="text-xs text-gray-400 font-medium mb-1">Age Range</p>
                                <p class="text-sm font-bold text-gray-900">{{ $module->age_range }} years old</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400 font-medium mb-1">Duration</p>
                                <p class="text-sm font-bold text-gray-900">{{ $module->duration_per_session }} mins/lesson</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- create & edit module modal --}}
    <div 
        x-show="showModuleModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Module Information</h2>

            <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                <input type="hidden" name="module_id" x-model="moduleData.id">
                <input type="hidden" name="existing_image" x-model="moduleData.image">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Module Name</label>
                            <input type="text" name="name" x-model="moduleData.name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="e.g. Coding Stories">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-800 mb-1">Age Range</label>
                                <input type="text" name="age_range" x-model="moduleData.age_range" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('age_range') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="e.g. 6 - 8">
                                @error('age_range')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-800 mb-1">Duration / Sessions (Mins)</label>
                                <input type="number" name="duration_per_session" min="0" step="5" x-model="moduleData.duration_per_session" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('duration_per_session') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="e.g. 60">
                                @error('duration_per_session')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-1">Course Type</label>
                            <select name="course_type_id" x-model="moduleData.course_type_id" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('course_type_id') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                <option value="" disabled selected>Select Course Type...</option>
                                @foreach($courseTypes as $courseType)
                                    <option value="{{ $courseType->id }}">{{ $courseType->name }}</option>
                                @endforeach
                            </select>
                            @error('course_type_id')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div x-show="moduleData.course_type_id == juniorKoderId" style="display: none;" x-transition>
                            <label class="block text-sm font-semibold text-gray-800 mb-1">Roadmap Category <span class="text-brand-pink">*</span></label>
                            <select name="category" x-model="moduleData.category" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('category') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                <option value="">Select Category...</option>
                                <option value="Game Development">Game Development</option>
                                <option value="Tech Innovator">Tech Innovator</option>
                                <option value="Software Development">Software Development</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">*Required for Junior Koder</p>
                            @error('category')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-1">Description</label>
                            <textarea name="description" rows="5" x-model="moduleData.description" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('description') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="Write module description here..."></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex flex-col h-full" x-data="{ fileName: null }">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Module Icon</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer transition relative hover:opacity-90">
                            <input type="file" 
                                name="image" 
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        fileName = file.name;
                                        imagePreview = URL.createObjectURL(file);
                                    } else {
                                        fileName = null;
                                        imagePreview = null;
                                    }
                                ">
                            
                            <template x-if="!imagePreview && !fileName">
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Icon</h4>
                                    <p class="text-xs font-medium text-gray-500">JPG, PNG, JPEG, GIF, SVG up to 2MB</p>
                                </div>
                            </template>

                            <template x-if="imagePreview || fileName">
                                <div class="flex flex-col items-center pointer-events-none text-center px-4 w-full h-full py-4 justify-center">
                                    
                                    <template x-if="imagePreview">
                                        <img :src="imagePreview" alt="Image Preview" class="w-24 h-24 rounded-full object-cover mb-3 shadow-md border-4 border-brand-pink">
                                    </template>
                                    
                                    <template x-if="!imagePreview">
                                        <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-3 shadow-md text-white">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    </template>

                                    <h4 class="font-semibold text-gray-900 mb-1" x-text="fileName ? 'Image Ready' : 'Current Module Icon'"></h4>
                                    <p class="text-xs font-medium text-gray-600 truncate max-w-[200px]" x-text="fileName"></p>
                                    <p class="text-xs font-normal text-gray-400 mt-2">(Click to change icon)</p>
                                </div>
                            </template>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="closeEditModal(); fileName = null" class="flex-1 py-3 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition">Save</button>
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
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Module?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to delete this module? This action cannot be undone.</p>

            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form :action="actionUrl" method="POST" class="flex-1">
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

</div>
@endsection