@extends('layouts.app')

@section('header_title', 'General Testimonial Management')

@section('content')
<div x-data="{ showTestimonialModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false }" class="max-w-7xl mx-auto">
    <div class="flex justify-between items-end mb-8">
        <div>
            <p class="text-sm font-medium text-gray-500">Manage general testimonials.</p>
        </div>
        <button @click="showTestimonialModal = true" class="px-6 py-2.5 w-[180px] h-[42px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            + Add Testimonial
        </button>
    </div>

    {{-- empty data --}}
    {{-- <div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col items-center justify-center min-h-[500px] p-8">
        <div class="w-20 h-20 bg-brand-light-yellow rounded-full flex items-center justify-center mb-6 shadow-sm">
            <svg class="w-10 h-10 text-brand-yellow" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        </div>

        <h2 class="text-xl font-semibold text-gray-900 mb-2">No testimonial yet</h2>
        <p class="text-md text-gray-500 font-medium mb-8">No testimonial data available yet.</p>

        <button @click="showTestimonialModal = true" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            Add your first testimonials
        </button>
    </div> --}}

    {{-- tabel data testimonial --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">

                <thead>
                    <tr class="border-b border-gray-100 bg-brand-light-blue">
                        <th class="py-3 px-4 text-center w-16">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </th>
                        <th class="py-3 px-4 text-md font-bold text-brand-blue whitespace-nowrap">Parents Name</th>
                        <th class="py-3 px-4 text-md font-bold text-brand-blue whitespace-nowrap">Testimonial Content</th>
                        <th class="py-3 px-4 text-md font-bold text-brand-blue whitespace-nowrap">Created By</th>
                        <th class="py-3 px-4 text-md font-bold text-brand-blue text-center whitespace-nowrap">Action</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- perulangan untuk menampilkan data event --}}
                    <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                        <td class="py-3 px-6 text-center">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-300 text-brand-blue focus:ring-brand-blue">
                        </td>
                        <td class="py-3 px-4 text-sm font-semibold text-gray-800">Nova Manohara</td>
                        <td class="py-3 px-4 text-sm font-normal text-gray-700">Saya senang dengan pembelajaran dan layanan yang diberikan.</td>
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
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                {{-- tombol edit --}}
                                <button @click="showTestimonialModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
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
                        <td class="py-3 px-4 text-sm font-semibold text-gray-800">Diva Andini</td>
                        <td class="py-3 px-4 text-sm font-normal text-gray-700">So fun so good.</td>
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
                                <button @click="showDetailModal = true" class="text-brand-blue hover:text-brand-blue-hover transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                {{-- tombol edit --}}
                                <button @click="showTestimonialModal = true" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
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

{{-- form modal untuk create dan edit --}}
    <div x-show="showTestimonialModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showTestimonialModal = false" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showTestimonialModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Add New General Testimonial</h2>

            <form action="#" method="POST" class="space-y-5">
                    
                <div>
                    <label class="block text-sm font-semibold mb-1 @error('name') text-red-500 @else text-gray-800 @enderror">Parents Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('name') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                    @error('name')
                        <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Description</label>
                    <textarea name="description" rows="8" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition" placeholder="Write event description here (5W+1H)..."></textarea>
                </div>
                
                <div class="flex items-end justify-end gap-2 pt-2">
                    <button type="button" @click="showTestimonialModal = false" class="py-2.5 bg-[#EE5B5B] w-48 h-12 hover:bg-red-600 text-white font-semibold rounded-lg transition text-md">Cancel</button>
                    <button type="submit" class="py-2.5 w-48 h-12 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-md">Save</button>
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
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Testimonial?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this testimonial data? This action cannot be undone.</p>
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>
    
</div>
@endsection
