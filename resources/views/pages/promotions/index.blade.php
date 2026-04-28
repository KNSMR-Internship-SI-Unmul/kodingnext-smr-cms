@extends('layouts.app')

@section('header_title', 'Promotion Management')

@section('content')
<div x-data="{ 
        showPromotionModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false, 
        showDetailModal: false,
        editMode: {{ old('promotion_id') ? 'true' : 'false' }},
        actionUrl: '{{ route('promotions.store') }}',

        promotionData: {
            id: @js(old('promotion_id', '')),
            title: @js(old('title', '')),
            description: @js(old('description', '')),
            image: '',
            start_date: @js(old('start_date', '')),
            end_date: @js(old('end_date', '')),
        },

        openEditModal(promotion) {
            this.editMode = true;
            this.actionUrl = `/promotions/${promotion.id}`;
            this.promotionData = { ...promotion };
            this.showPromotionModal = true;
        },

        openDeleteModal(promotionId) {
            this.actionUrl = `/promotions/${promotionId}`;
            this.showDeleteModal = true;
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showPromotionModal = false;
            @endif
        },

        resetModal() {
            this.editMode = false;
            this.actionUrl = '{{ route('promotions.store') }}';
            this.promotionData = { id: '', title: '', description: '', image: '', start_date: '', end_date: '' };
            this.showPromotionModal = true;
        },

        openDetailModal(promotion) {
            this.promotionData = { ...promotion };
            this.showDetailModal = true;
        }
    }" 
    class="max-w-7xl mx-auto"
>

    <div class="flex flex-wrap items-end gap-4 mb-8">
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Promotion</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                <input type="text" placeholder="Search promotion by title" class="w-full pl-10 pr-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search by Date</label>
            <div class="relative">
                <input type="date" class="w-full px-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm">
            </div>
        </div>

        <div class="flex gap-2">
            <button @click="resetModal()" class="px-6 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm">
                + Add Promotion
            </button>
        </div>
    </div>

    @if($promotions->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No promotions yet" 
                description="No promotion data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first promotion
                </button>
            </x-empty-state>
        </div>
    @else
        <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-100 bg-brand-light-blue">
                            <th class="py-3 px-6 text-center w-16">
                                <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                            </th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Promotion Title</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Start Date</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">End Date</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Format</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Created By</th>
                            <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($promotions as $promotion)
                            <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                                <td class="py-3 px-6 text-center">
                                    <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                                </td>
                                <td class="py-3 px-4 text-sm font-bold text-gray-800">{{ $promotion->title }}</td>
                                <td class="py-3 px-4 text-sm font-semibold text-gray-700">{{ $promotion->start_date->format('d/m/Y') }}</td>
                                <td class="py-3 px-4 text-sm font-semibold text-gray-700">{{ $promotion->end_date->format('d/m/Y') }}</td>
                                <td class="py-3 px-4 text-sm font-semibold text-gray-700">{{ $promotion->format }}</td>
                                <td class="py-3 px-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                            <img src="{{ $promotion->user->profile_picture ? asset('storage/' . $promotion->user->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($promotion->user->name) . '&color=3D7D9E&background=EEF6FB' }}" alt="Profile Picture" class="w-full h-full object-cover">
                                        </div>
                                        <span class="text-sm font-semibold text-gray-700">{{ $promotion->user->name ?? 'N/A' }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6">
                                    <div class="flex items-center justify-center gap-3">
                                        <button @click="openDetailModal({{ json_encode($promotion) }})" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </button>
                                        <button @click="openEditModal({{ json_encode($promotion) }})" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </button>
                                        <button @click="openDeleteModal({{ $promotion->id }})" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
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
    @endif
    

    {{-- create & edit promotion modal --}}
    <div x-show="showPromotionModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Promotion Information</h2>

            <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                <input type="hidden" name="promotion_id" x-model="promotionData.id">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Title</label>
                            <input type="text" name="title" x-model="promotionData.name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('title') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Start Date</label>
                            <input type="date" name="start_date" x-model="promotionData.start_date" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('start_date') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror"">
                            @error('start_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">End Date</label>
                            <input type="date" name="end_date" x-model="promotionData.end_date" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('end_date') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror"">
                            @error('end_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Description</label>
                            <textarea name="description" x-model="promotionData.description" rows="4" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('description') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror""></textarea>
                            @error('description')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="flex flex-col h-full" x-data="{ fileName: null }">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Image</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer transition relative hover:opacity-90">
                            <input type="file" 
                                name="image" 
                                accept="image/*"
                                required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                @change="fileName = $event.target.files[0] ? $event.target.files[0].name : null">
                            
                            <template x-if="!fileName">
                                <div class="flex flex-col items-center pointer-events-none">
                                    <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Image</h4>
                                    <p class="text-xs font-medium text-gray-500">JPEG,PNG,JPG,GIF,SVG up to 2MB</p>
                                </div>
                            </template>

                            <template x-if="fileName">
                                <div class="flex flex-col items-center pointer-events-none text-center px-4">
                                    <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <h4 class="font-semibold text-gray-900 mb-1">Image Uploaded</h4>
                                    <p class="text-xs font-medium text-gray-600 truncate max-w-[200px]" x-text="fileName"></p>
                                    <p class="text-xs font-normal text-gray-400 mt-2">(Click again to change image)</p>
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
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Promotion?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this promotion data? This action cannot be undone.</p>
            
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- promotion view modal --}}
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg p-8 md:p-10 w-full max-w-3xl shadow-2xl relative mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 text-gray-800 hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-3xl font-semibold text-brand-pink mb-8">Promotion Details</h2>

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