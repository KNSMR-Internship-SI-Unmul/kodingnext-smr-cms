@extends('layouts.app')

@section('header_title', 'Module Management')

@section('content')
<div x-data="{ showModuleModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false }" class="p-2">

    <div class="flex flex-wrap items-end gap-4 mb-8">
        
        <div class="flex-[2] min-w-[250px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Search Module</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </span>
                {{-- input pencarian berdasarkan 'name' --}}
                <input type="text" placeholder="Search module by name" class="w-full pl-10 pr-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
            </div>
        </div>

        <div class="flex-1 min-w-[200px]">
            <label class="block text-sm font-semibold text-gray-800 mb-2">Course Types</label>
            {{-- input pencarian berdasarkan 'program' --}}
            <select class="w-full px-4 py-2.5 rounded-lg border border-gray-200 text-gray-500 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white text-sm">
                <option value="">All Course Type</option>
                <option value="1">Little Koders</option>
                <option value="2">Junior Koders</option>
            </select>
        </div>
        
        <div>
            <button @click="showModuleModal = true" class="px-8 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm">
                + Add Module
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3 gap-8">
        
        <div class="bg-brand-light-pink rounded-lg p-4 shadow-sm flex flex-col h-full relative group transform transition-all hover:-translate-y-2 hover:shadow-sm">
            <div class="absolute top-6 right-6 z-10" x-data="{ openDropdown: false }">
                <button @click="openDropdown = !openDropdown" class="text-brand-pink hover:text-brand-pink-hover focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-pink/10">
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
                    <button @click="openDropdown = false; showModuleModal = true" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-pink flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Edit
                    </button>
                    <button @click="openDropdown = false; showDeleteModal = true" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors border-t border-gray-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </div>
            </div>
            
            <div class="w-full h-44 bg-white/60 rounded-lg mb-4 overflow-hidden relative border border-white/50 flex-shrink-0">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjZTVlN2ViIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2Y5ZmFmYiIvPjxyZWN0IHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiNmOWZhZmIiLz48cmVjdCB4PSIxMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2U1ZTdlYiIvPjwvc3ZnPg==')] opacity-40"></div>
                {{-- <img src="URL_GAMBAR" alt="Cover" class="w-full h-full object-cover"> --}}
            </div>
            
            {{-- Judul dan Kategori --}}
            <div class="px-2 mb-4">
                <h3 class="font-extrabold text-gray-900 text-lg leading-tight mb-0.5">Coding Stories</h3>
                <p class="text-sm font-medium text-gray-500">Little Koders</p>
            </div>
            
            <div class="bg-white rounded-lg p-5 flex-1 flex flex-col border border-brand-pink shadow-sm">
                <p class="text-xs text-gray-800 leading-relaxed mb-4 flex-1">
                    Siswa akan mempelajari konsep dasar coding dan berlatih berpikir logis melalui kegiatan yang menyenangkan dan alat yang sesuai dengan usia mereka. Mereka akan membuat animasi, membuat kode, dan memainkan board game berbasis cerita.
                </p>
                
                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                    <div>
                        <p class="text-xs text-gray-400 font-medium mb-1">Age Range</p>
                        <p class="text-sm font-bold text-gray-900">4 - 6 y.o</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-medium mb-1">Duration</p>
                        <p class="text-sm font-bold text-gray-900">45 mins/lesson</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-brand-light-blue rounded-lg p-4 shadow-sm hover:shadow-md flex flex-col h-full relative group transform transition-all hover:-translate-y-1">
            <div class="absolute top-6 right-6 z-10" x-data="{ openDropdown: false }">
                <button @click="openDropdown = !openDropdown" class="text-brand-blue hover:text-brand-blue-hover focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-blue/10">
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
                    <button @click="openDropdown = false; showModuleModal = true" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-blue flex items-center gap-2 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        Edit
                    </button>
                    <button @click="openDropdown = false; showDeleteModal = true" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors border-t border-gray-100">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete
                    </button>
                </div>
            </div>
            
            <div class="w-full h-44 bg-white/60 rounded-lg mb-4 overflow-hidden relative border border-white/50 flex-shrink-0">
                <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PHJlY3Qgd2lkdGg9IjEwIiBoZWlnaHQ9IjEwIiBmaWxsPSIjZTVlN2ViIi8+PHJlY3QgeD0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2Y5ZmFmYiIvPjxyZWN0IHk9IjEwIiB3aWR0aD0iMTAiIGhlaWdodD0iMTAiIGZpbGw9IiNmOWZhZmIiLz48cmVjdCB4PSIxMCIgeT0iMTAiIHdpZHRoPSIxMCIgaGVpZ2h0PSIxMCIgZmlsbD0iI2U1ZTdlYiIvPjwvc3ZnPg==')] opacity-40"></div>
            </div>
            
            <div class="px-2 mb-4">
                <h3 class="font-bold text-gray-900 text-lg leading-tight mb-0.5">2D Games With Roblox</h3>
                <p class="text-sm font-medium text-gray-500">Junior Koders</p>
            </div>
            
            <div class="bg-white rounded-lg p-5 flex-1 flex flex-col border border-brand-blue shadow-sm">
                <p class="text-xs text-gray-800 leading-relaxed mb-4 flex-1">
                    Siswa akan belajar cara membuat dan memprogram animasi dan game sederhana melalui berbagai tugas dan proyek. Mempelajari elemen dan konsep dasar game dan menerapkan pengetahuan ini untuk membuat proyek game mereka sendiri.
                </p>
                
                <div class="flex items-center justify-between border-t border-gray-100 pt-4">
                    <div>
                        <p class="text-xs text-gray-400 font-medium mb-1">Age Range</p>
                        <p class="text-sm font-bold text-gray-900">8 - 12 y.o</p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-medium mb-1">Duration</p>
                        <p class="text-sm font-bold text-gray-900">90 mins/lesson</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    {{-- form modal untuk create dan edit --}}
    <div 
        x-show="showModuleModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showModuleModal = false" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showModuleModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Module Information</h2>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        
                        <div>
                            <label class="block text-sm font-semibold mb-2 @error('name') text-red-500 @else text-gray-800 @enderror">
                                Module Name
                            </label>
                            
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 transition @error('name') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror" placeholder="e.g. Coding Stories">
                            @error('name')
                                <p class="text-red-500 text-xs font-bold mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Age Range</label>
                                <input type="text" name="age_range" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition" placeholder="e.g. 6 - 8">
                            </div>
                            
                            <div class="flex-1">
                                <label class="block text-sm font-semibold text-gray-800 mb-2">Duration / Sessions (Mins)</label>
                                <input type="number" name="duration_per_session" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition" placeholder="e.g. 60">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Course Type</label>
                            <select name="course_type_id" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition appearance-none bg-white">
                                <option value="" disabled selected>Select Course Type...</option>
                                <option value="1">Little Koders</option>
                                <option value="2">Junior Koders</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">Description</label>
                            <textarea name="description" rows="4" class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition" placeholder="Write module description here..."></textarea>
                        </div>
                    </div>

                    {{-- form upload file --}}
                    <div class="flex flex-col h-full">
                        <label class="block text-xl font-semibold text-gray-800 mb-4">Module Image</label>
                        
                        <div class="flex-1 min-h-[200px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer hover:opacity-80 transition relative">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Image</h4>
                            <p class="text-xs font-medium text-gray-500">PNG, JPG, WEBP up to 2MB</p>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="showModuleModal = false" class="flex-1 py-3 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition shadow-sm">Save</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    {{-- modal konfirmasi untuk hapus --}}
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Module?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to delete this module? This action cannot be undone.</p>

            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="#" method="POST" class="flex-1">
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition shadow-md">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection