@extends('layouts.app')

@section('header_title', 'General Testimonial Management')

@section('content')
<div x-data="generalTestimonialManager({
        hasErrors: {{ $errors->any() ? 'true' : 'false' }},
        storeRoute: '{{ route('general-testimonials.store') }}',
        bulkDestroyRoute: '{{ route('general-testimonials.bulkDestroy') }}',
        testimonialIds: @js($testimonials->pluck('id')),
        testimonialCount: {{ $testimonials->count() }},
        oldTestimonialId: @js(old('general_testimonial_id', '')),
        oldParentsName: @js(old('parents_name', '')),
        oldReviewContent: @js(old('review_content', '')),
        oldIsPublished: @js(old('is_published', false)),
    })"
>
    <div class="flex justify-between items-end mb-8">
        <div>
            <p class="text-md font-medium text-gray-500">Manage general testimonials.</p>
        </div>
        <div class="flex gap-4">
            <button type="button" x-show="selectedTestimonials.length > 0" @click="openBulkDeleteModal()" x-transition class="px-4 py-2.5 h-[42px] gap-1 bg-red-100 hover:bg-red-500 text-red-600 hover:text-white font-semibold rounded-lg transition text-sm flex items-center justify-center" style="display: none;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </button>

            <button type="button" @click="resetModal()" class="px-6 py-2.5 h-[42px] min-w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm flex items-center justify-center">
                + Add Testimonial
            </button>
        </div>
    </div>

    {{-- empty state --}}
    @if($testimonials->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No testimonials yet" 
                description="No testimonial data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first testimonial
                </button>
            </x-empty-state>
        </div>
    @else
        {{-- testimonial table --}}
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse table-fixed lg:table-auto">
                    <thead>
                        <tr class="border-b border-gray-100 bg-brand-light-blue">
                            <th class="py-3 px-4 text-center w-16">
                                <input type="checkbox" @click="toggleAll()" :checked="allSelected" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                            </th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Parents Name</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Testimonial Content</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Created By</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Published</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $testimonial)
                            <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                                <td class="py-3 px-6 text-center">
                                    <input type="checkbox" value="{{ $testimonial->id }}" x-model="selectedTestimonials" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue cursor-pointer">
                                </td>
                                <td class="py-3 px-4 text-sm font-semibold text-gray-800">{{ $testimonial->parents_name }}</td>
                                <td class="py-3 px-4">
                                    <div class="max-w-[250px] md:min-w-[350px]">
                                        <p class="text-sm font-medium text-gray-700 text-justify">{{ $testimonial->review_content }}</p>
                                        </p>
                                    </div>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    <div class="flex items-center justify-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="{{ $testimonial->user?->profile_picture ? asset('storage/' . $testimonial->user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($testimonial->user?->name ?? 'Unknown') . '&color=3D7D9E&background=EEF6FB' }}" alt="{{ $testimonial->user?->name }}'s Profile Picture" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">{{ $testimonial->user?->short_name ?? 'Unknown' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4 text-center whitespace-nowrap">
                                    @if($testimonial->is_published)
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-green-100 text-green-700 border border-green-200">
                                            Published
                                        </span>
                                    @else
                                        <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-[11px] font-bold bg-red-100 text-red-700 border border-red-200">
                                            Not Published
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center justify-center gap-3">
                                        <button @click="openDetailModal({{ json_encode($testimonial) }})" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                        <button @click="openEditModal({{ json_encode($testimonial) }})" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button @click="openDeleteModal({{ $testimonial->id }})" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
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
                Showing <span class="font-medium text-gray-900">{{ $testimonials->firstItem() ?? 0 }}</span> to <span class="font-medium text-gray-900">{{ $testimonials->lastItem() ?? 0 }}</span> of <span class="font-semibold text-brand-blue">{{ $testimonials->total() }}</span> testimonials
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

                <span>Page {{ $testimonials->currentPage() }} of {{ $testimonials->lastPage() }}</span>

                <div class="flex items-center gap-4">
                    @if ($testimonials->onFirstPage())
                        <span class="text-gray-300 cursor-not-allowed flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </span>
                    @else
                        <a href="{{ $testimonials->previousPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            Prev
                        </a>
                    @endif

                    @if ($testimonials->hasMorePages())
                        <a href="{{ $testimonials->nextPageUrl() }}&search={{ request('search') }}&date={{ request('date') }}&per_page={{ request('per_page') }}" class="text-brand-blue hover:text-brand-blue-hover transition-colors flex items-center gap-1 font-medium">
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

    {{-- create & edit testimonial modal --}}
    <div x-show="showTestimonialModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">General Testimonial</h2>

            <form :action="actionUrl" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                <input type="hidden" name="general_testimonial_id" x-model="testimonialData.id">
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Name</label>
                    <input type="text" name="parents_name" x-model="testimonialData.parents_name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('parents_name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                    @error('parents_name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Testimonial Content</label>
                    <textarea name="review_content" rows="5" x-model="testimonialData.review_content" required class="block w-full px-4 py-2.5 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('review_content') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="Write testimonial here..."></textarea>
                    @error('review_content')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center gap-2">
                    <input type="checkbox" id="is_published" name="is_published" value="1" x-model="testimonialData.is_published" class="w-5 h-5 text-brand-pink focus:ring-brand-pink border-gray-300 rounded cursor-pointer transition">
                    <label for="is_published" class="text-sm font-semibold text-gray-900 cursor-pointer select-none">Publish Testimonial</label>
                </div>
                
                <div class="flex gap-3 pt-2 justify-end">
                    <button type="button" @click="closeEditModal()" class="py-2.5 w-1/4 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition text-sm">Cancel</button>
                    <button type="submit" class="py-2.5 w-1/4 bg-brand-pink text-white hover:bg-brand-pink-hover font-semibold rounded-lg transition text-sm">Save</button>
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
                <span x-show="deleteMode === 'single'">Delete Testimonial?</span>
                <span x-show="deleteMode === 'bulk'">Delete <span x-text="selectedTestimonials.length"></span> Testimonials?</span>
            </h3>
            
            <p class="text-sm text-gray-500 mb-6 font-medium" 
                x-text="deleteMode === 'single' ? 'Are you sure you want to remove this testimonial data? This action cannot be undone.' : 'Are you sure you want to remove all selected data? This action cannot be undone.'">
            </p>

            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                
                <form :action="actionUrl" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <template x-if="deleteMode === 'bulk'">
                        <template x-for="id in selectedTestimonials" :key="id">
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
