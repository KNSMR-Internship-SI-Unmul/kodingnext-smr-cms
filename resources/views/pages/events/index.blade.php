@extends('layouts.app')

@section('header_title', 'Event Management')

@section('content')
<div x-data="eventManager({ 
        hasErrors: {{ $errors->any() ? 'true' : 'false' }},
        storeRoute: '{{ route('events.store') }}',
        bulkDestroyRoute: '{{ route('events.bulkDestroy') }}',
        eventIds: @js($events->pluck('id')),
        eventCount: {{ $events->count() }},
        oldEventId: @js(old('event_id', '')),
        oldName: @js(old('name', '')),
        oldDescription: @js(old('description', '')),
        oldImage: @js(old('existing_image', '')),
        oldEventDate: @js(old('event_date', '')),
    })"
    class="max-w-7xl mx-auto"
>

    <form method="GET" action="{{ route('events.index') }}" class="flex flex-wrap items-end gap-4 mb-8 w-full">
        <input type="hidden" name="per_page" id="per_page_input" value="{{ request('per_page', 10) }}">
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Event</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search event by name" class="w-full pl-10 pr-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm" @input.debounce.500ms="$el.form.submit()">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search by Date</label>
            <div class="relative">
                <input type="date" name="date" value="{{ request('date') }}" class="w-full px-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm" @change="$el.form.submit()">
            </div>
        </div>

        @if(request('search') || request('date'))
            <div class="flex gap-2">
                <a href="{{ route('events.index') }}" class="px-4 py-2.5 h-[42px] bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-lg transition text-sm flex items-center justify-center" title="Clear Filters">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3"></path></svg>
                </a>    
            </div>
        @endif

        <div class="flex items-center gap-4">
            <button type="button" x-show="selectedEvents.length > 0" @click="openBulkDeleteModal()" x-transition class="px-4 py-2.5 h-[42px] gap-1 bg-red-100 hover:bg-red-500 text-red-600 hover:text-white font-semibold rounded-lg transition text-sm flex items-center justify-center" style="display: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>

            <button type="button" @click="resetModal()" class="px-6 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm">
                + Add Event
            </button>
        </div>
    </form>

    {{-- empty state --}}
    @if($events->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No events yet" 
                description="No event data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first event
                </button>
            </x-empty-state>
        </div>
    @else
        {{-- event table --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">

                    <thead>
                        <tr class="border-b border-gray-100 bg-brand-light-blue">
                            <th class="py-3 px-4 text-center w-16">
                                <input type="checkbox" @click="toggleAll()" :checked="allSelected" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                            </th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Event Name</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Event Date</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Format</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Created By</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($events as $event)
                        <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                            <td class="py-3 px-6 text-center">
                                <input type="checkbox" value="{{ $event->id }}" x-model="selectedEvents" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                            </td>
                            <td class="py-3 px-4 text-sm font-bold text-gray-800">{{ $event->name }}</td>
                            <td class="py-3 px-4 text-sm font-semibold text-gray-700 text-center">{{ $event->event_date->format('d/m/Y') }}</td>
                            <td class="py-3 px-4 text-sm font-semibold text-gray-700 text-center">{{ $event->file_format }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-2">
                                    <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                        <img src="{{ $event->user?->profile_picture ? asset('storage/' . $event->user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($event->user?->name ?? 'Unknown') . '&color=3D7D9E&background=EEF6FB' }}" alt="{{ $event->user?->name }}'s Profile Picture" class="w-full h-full object-cover">
                                    </div>
                                    <span class="text-sm font-semibold text-gray-700">{{ $event->user?->short_name ?? 'Unknown' }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="openDetailModal({{ json_encode($event) }})" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </button>
                                    <button @click="openEditModal({{ json_encode($event) }})" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button @click="openDeleteModal({{ $event->id }})" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
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
                Showing <span class="font-medium text-gray-900">{{ $events->firstItem() ?? 0 }}</span> to <span class="font-medium text-gray-900">{{ $events->lastItem() ?? 0 }}</span> of <span class="font-semibold text-brand-blue">{{ $events->total() }}</span> events
            </div>
            
            <div class="flex items-center gap-6 mt-4 sm:mt-0">
                <div class="flex items-center gap-2">
                    <span>Rows per page</span>
                    <select 
                        class="border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-brand-pink bg-white"
                        @change="
                            document.getElementById('per_page_input').value = $event.target.value;
                            document.getElementById('per_page_input').closest('form').submit();
                        "
                    >
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <span>Page {{ $events->currentPage() }} of {{ $events->lastPage() }}</span>

                <div class="flex items-center gap-4">
                    @if ($events->onFirstPage())
                        <span class="text-gray-300 cursor-not-allowed flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </span>
                    @else
                        <a href="{{ $events->previousPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </a>
                    @endif

                    @if ($events->hasMorePages())
                        <a href="{{ $events->nextPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
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

    {{-- create & edit event modal --}}
    <div x-show="showEventModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Event Information</h2>

            <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                <input type="hidden" name="event_id" x-model="eventData.id">
                <input type="hidden" name="existing_image" x-model="eventData.image">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Name</label>
                            <input type="text" name="name" x-model="eventData.name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Event Date</label>
                            <input type="date" name="event_date" x-model="eventData.event_date" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('event_date') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('event_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Description</label>
                            <textarea name="description" rows="8" x-model="eventData.description" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('description') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="Write event description here (5W+1H)..."></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex flex-col h-full" x-data="{ fileName: null }">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Event Image</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer transition relative hover:opacity-90">
                            <input type="file" 
                                name="image" 
                                accept="image/*"
                                :required="!editMode"
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
                                    <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Image</h4>
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

                                    <h4 class="font-semibold text-gray-900 mb-1" x-text="fileName ? 'Image Ready' : 'Current Event Image'"></h4>
                                    <p class="text-xs font-medium text-gray-600 truncate max-w-[200px]" x-text="fileName"></p>
                                    <p class="text-xs font-normal text-gray-400 mt-2">(Click to change image)</p>
                                </div>
                            </template>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="closeEditModal(); fileName = null" class="flex-1 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-pink text-white hover:bg-brand-pink-hover font-semibold rounded-lg transition">Save</button>
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
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">
                <span x-show="deleteMode === 'single'">Delete Event?</span>
                <span x-show="deleteMode === 'bulk'">Delete <span x-text="selectedEvents.length"></span> Events?</span>
            </h3>
            
            <p class="text-sm text-gray-500 mb-6 font-medium" 
                x-text="deleteMode === 'single' ? 'Are you sure you want to remove this event data? This action cannot be undone.' : 'Are you sure you want to remove all selected data? This action cannot be undone.'">
            </p>

            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                
                <form :action="actionUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <template x-if="deleteMode === 'bulk'">
                        <template x-for="id in selectedEvents" :key="id">
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

    {{-- event view modal --}}
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg p-8 md:p-10 w-full max-w-3xl shadow-2xl relative mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 text-gray-800 hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-3xl font-semibold text-brand-pink mb-8">Event Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-[1fr_1.5fr] gap-8 md:gap-12">
                <div class="w-full rounded-lg border border-gray-200 overflow-hidden bg-gray-50 aspect-[3/4] flex items-center justify-center relative">
                    <template x-if="eventData.image">
                        <img :src="'/storage/' + eventData.image" class="w-full h-full object-cover">
                    </template>
                    <template x-if="!eventData.image">
                        <div class="w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjZTVlN2ViIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2Y5ZmFmYiIvPjxyZWN0IHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiNmOWZhZmIiLz48cmVjdCB4PSIxMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2U1ZTdlYiIvPjwvc3ZnPg==')] opacity-50"></div>
                    </template>
                </div>

                <div class="flex flex-col pt-2">
                    <div class="flex items-center gap-3 mb-4 text-brand-pink">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            <text x="12" y="16" text-anchor="middle" font-size="6" font-family="sans-serif" font-weight="medium" fill="currentColor">11</text>
                        </svg>
                        <span class="text-lg font-medium" x-text="eventData.formatted_event_date"></span>
                    </div>

                    <h3 class="text-2xl font-medium text-brand-pink mb-5" x-text="eventData.name"></h3>

                    <p class="text-gray-800 text-sm leading-relaxed flex-1" x-text="eventData.description"></p>
                </div>
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