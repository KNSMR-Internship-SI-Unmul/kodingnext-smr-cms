@extends('layouts.app')

@section('header_title', 'Event Management')

@section('content')
<div x-data="{ showEventModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false, showDetailModal: false }">

    <div class="flex flex-wrap items-end gap-4 mb-8">
        
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Event</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                {{-- input pencarian berdasarkan 'name' --}}
                <input type="text" placeholder="Search event by name" class="w-full pl-10 pr-4 h-[42px] rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
            </div>
        </div>

        <div class="flex-[2] min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search by Date</label>
            <div class="relative">
                {{-- input pencarian berdasarkan 'date' --}}
                <input type="date" class="w-full px-4 h-[42px] rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm">
            </div>
        </div>

        <div>
            <button @click="showEventModal = true" class="px-8 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm">
                + Add Event
            </button>
        </div>
    </div>

    {{-- tabel data event --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="border-b border-gray-100 bg-brand-light-blue">
                        <th class="py-3 px-4 text-center w-16">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Event Name</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Event Date</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Format</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Created By</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- perulangan untuk menampilkan data event --}}
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-6 text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </td>
                        <td class="py-3 px-4 text-sm font-bold text-gray-800">Fun Day CNY</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">13/03/2026</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">IMAGE</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                    <svg class="w-full h-full text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Rinda</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                {{-- tombol view untuk melihat detail --}}
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                {{-- tombol edit --}}
                                <button @click="showEventModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                {{-- tombol hapus --}}
                                <button @click="showDeleteModal = true" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-6 text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </td>
                        <td class="py-3 px-4 text-sm font-bold text-gray-800">Fun Day CNY</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">13/03/2026</td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-700">IMAGE</td>
                        <td class="py-3 px-4">
                            <div class="flex items-center gap-2">
                                <div class="w-6 h-6 rounded-full bg-gray-200 overflow-hidden">
                                    <svg class="w-full h-full text-gray-400 mt-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                </div>
                                <span class="text-sm font-semibold text-gray-700">Rinda</span>
                            </div>
                        </td>
                        <td class="py-3 px-4">
                            <div class="flex items-center justify-center gap-3">
                                {{-- tombol view untuk melihat detail --}}
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-[#4996BE] transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                {{-- tombol edit --}}
                                <button @click="showEventModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </button>
                                {{-- tombol hapus --}}
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

    {{-- form modal untuk create dan edit --}}
    <div x-show="showEventModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showEventModal = false" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showEventModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Event Information</h2>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-2 @error('name') text-red-500 @else text-gray-800 @enderror">Event Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('name') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-800">Event Date</label>
                            <input type="date" name="event_date" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-2 text-gray-800">Description</label>
                            <textarea name="description" rows="8" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition" placeholder="Write event description here (5W+1H)..."></textarea>
                        </div>
                    </div>
                    
                    {{-- form upload file --}}
                    <div class="flex flex-col h-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">File Upload</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer hover:opacity-80 transition relative">
                            <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*,video/*,application/pdf">
                            <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Click for Upload File</h4>
                            <p class="text-xs font-medium text-gray-500">PDF, IMAGE, JPG, PNG, JPEG</p>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="showEventModal = false" class="flex-1 py-3 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition">Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- modal konfirmasi hapus --}}
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Event?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this event data? This action cannot be undone.</p>
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

    {{-- modal detail event --}}
    <div x-show="showDetailModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDetailModal = false" class="bg-white rounded-lg p-8 md:p-10 w-full max-w-3xl shadow-2xl relative mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showDetailModal = false" class="absolute top-6 right-6 text-gray-800 hover:text-gray-500 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-3xl font-semibold text-brand-pink mb-8">Event Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-[1fr_1.5fr] gap-8 md:gap-12">
                <div class="w-full rounded-lg border border-gray-200 overflow-hidden bg-gray-50 aspect-[3/4] flex items-center justify-center">
                    <div class="w-full h-full bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjZTVlN2ViIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2Y5ZmFmYiIvPjxyZWN0IHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiNmOWZhZmIiLz48cmVjdCB4PSIxMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2U1ZTdlYiIvPjwvc3ZnPg==')] opacity-50"></div>
                </div>

                <div class="flex flex-col pt-2">
                    <div class="flex items-center gap-3 mb-4 text-brand-pink">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            <text x="12" y="16" text-anchor="middle" font-size="6" font-family="sans-serif" font-weight="medium" fill="currentColor">11</text>
                        </svg>
                        <span class="text-lg font-medium">30 April 2026</span>
                    </div>

                    <h3 class="text-2xl font-medium text-brand-pink mb-5">Fun Day Chinese New Year 2026</h3>

                    <p class="text-gray-800 text-sm leading-relaxed flex-1">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus at dapibus risus. Donec eu odio id risus laoreet vehicula nec quis massa. Phasellus dapibus turpis eget lacus pretium varius. Nulla at quam non augue dapibus ultricies.
                    </p>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection