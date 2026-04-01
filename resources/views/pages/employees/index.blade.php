@extends('layouts.app')

@section('header_title', 'Employees')

@section('content')
<div x-data="{ showEmployeeModal: {{ $errors->any() ? 'true' : 'false' }}, showDeleteModal: false }" class="p-2">

    <div class="mb-8 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" placeholder="Search user by name" class="w-full pl-12 pr-4 py-3.5 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
    </div>

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
            <span class="text-brand-pink">9</span> Employee
        </h1>
        <button @click="showEmployeeModal = true" class="px-6 py-2.5 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition">
            + Add Candidate
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        
        <div class="bg-gradient-to-b from-brand-light-pink from-40% to-brand-pink to-75% rounded-lg p-4 shadow-lg flex flex-col h-full relative group transform transition-all hover:-translate-y-2 hover:shadow-lg">
            
            <div class="absolute top-4 right-4" x-data="{ openDropdown: false }">
                <button @click="openDropdown = !openDropdown" class="text-brand-pink hover:text-[#CD4D8C] focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-pink/10">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                </button>
                
                <div 
                    x-show="openDropdown" 
                    @click.away="openDropdown = false"
                    style="display: none;"
                    class="absolute right-0 mt-1 w-36 bg-white rounded-lg shadow-xl border border-gray-100 z-20 overflow-hidden"
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

            <div class="relative w-14 h-14 rounded-full bg-gray-200 mb-4 border-2 border-white shadow-sm flex-shrink-0">
                <img src="https://i.pravatar.cc/150?img=1" alt="Profile" class="w-full h-full rounded-full object-cover">
            </div>
            
            <h3 class="font-extrabold text-gray-900 text-base leading-tight">Rinda Lailatul Arofah S.Kom</h3>
            <p class="text-[11px] font-medium text-gray-500 mb-4">Student Advisor</p>

            <div class="bg-white rounded-xl border border-brand-pink p-4 flex-1 flex flex-col justify-center">
                <div class="flex justify-between mb-4 border-b border-gray-100 pb-3">
                    <div>
                        <p class="text-[10px] text-gray-400 mb-0.5">Program</p>
                        <p class="text-xs font-bold text-gray-900">-</p>
                    </div>
                    <div class="text-right">
                        <p class="text-[10px] text-gray-400 mb-0.5">Hire Date</p>
                        <p class="text-xs font-bold text-gray-900">10/10/2026</p>
                    </div>
                </div>
                
                <div class="space-y-2.5">
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <p class="text-[11px] font-medium text-gray-700">rinda@kodingnext.com</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <p class="text-[11px] font-medium text-gray-700">0812 2346 4567</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="bg-gradient-to-b from-brand-light-blue from-40% to-brand-blue to-75% rounded-lg p-4 shadow-lg flex flex-col h-full relative group transform transition-all hover:-translate-y-2 hover:shadow-lg">
                
            <div class="absolute top-4 right-4" x-data="{ openDropdown: false }">
                <button @click="openDropdown = !openDropdown" class="text-brand-blue hover:text-[#4996BE] focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-blue/10">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                </button>
                
                <div 
                    x-show="openDropdown" 
                    @click.away="openDropdown = false"
                    style="display: none;"
                    class="absolute right-0 mt-1 w-36 bg-white rounded-lg shadow-xl border border-gray-100 z-20 overflow-hidden"
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

                <div class="relative w-14 h-14 rounded-full bg-gray-200 mb-4 border-2 border-white shadow-sm flex-shrink-0">
                    <img src="https://i.pravatar.cc/150?img=11" alt="Profile" class="w-full h-full rounded-full object-cover">
            </div>
                
                <h3 class="font-extrabold text-gray-900 text-base leading-tight">Mr. Eko S.Kom</h3>
                <p class="text-[11px] font-medium text-gray-500 mb-4">Advanced Teacher</p>

                <div class="bg-white rounded-xl border border-brand-blue p-4 flex-1 flex flex-col justify-center">
                    <div class="flex justify-between mb-4 border-b border-gray-100 pb-3">
                        <div>
                            <p class="text-[10px] text-gray-400 mb-0.5">Program</p>
                            <p class="text-xs font-bold text-gray-900">Junior Koders</p>
                        </div>
                        <div class="text-right">
                            <p class="text-[10px] text-gray-400 mb-0.5">Hire Date</p>
                            <p class="text-xs font-bold text-gray-900">10/10/2023</p>
                        </div>
                    </div>
                    
                    <div class="space-y-2.5">
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <p class="text-[11px] font-medium text-gray-700">eko@kodingnext.com</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <p class="text-[11px] font-medium text-gray-700">0812 2346 4567</p>
                        </div>
                    </div>
                </div>

        </div>
        
        </div>

    <div x-show="showEmployeeModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showEmployeeModal = false" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="showEmployeeModal = false" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Employee Information</h2>

            <form action="#" method="POST">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold mb-1 @error('name') text-red-500 @else text-gray-800 @enderror">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2.5 rounded-lg border focus:outline-none focus:ring-2 transition @error('name') border-red-500 bg-red-50 @else border-gray-300 focus:ring-brand-pink @enderror">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Hire Date</label>
                            <input type="date" name="hired_date" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Phone Number</label>
                            <input type="text" name="phone_number" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-800">Email</label>
                                <input type="email" name="email" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-800">Password</label>
                                <input type="password" name="password" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 pt-2">
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-gray-800">Role</label>
                                <select name="role_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition bg-white text-sm">
                                    <option value="" disabled selected>Select Role</option>
                                    <option value="1">Student Advisor</option>
                                    <option value="2">Advanced Teacher</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-gray-800">Program</label>
                                <select name="course_type_id" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink transition bg-white text-sm">
                                    <option value="" disabled selected>Select Program</option>
                                    <option value="1">Little Koders</option>
                                    <option value="2">Junior Koders</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col h-full">
                        <label class="block text-lg font-semibold text-gray-800 mb-3">Profile Picture</label>
                        
                        <div class="flex-1 min-h-[200px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer hover:opacity-80 transition relative">
                            <input type="file" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*">
                            <div class="w-16 h-16 bg-brand-pink rounded-full flex items-center justify-center mb-4 shadow-md text-white">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">Click for Upload Image</h4>
                            <p class="text-xs font-medium text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                        </div>

                        <div class="flex gap-4 mt-8">
                            <button type="button" @click="showEmployeeModal = false" class="flex-1 py-3 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Cancel</button>
                            <button type="submit" class="flex-1 py-3 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition shadow-sm">Save Data</button>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="showDeleteModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            </div>
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Employee?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this employee data? This action cannot be undone.</p>
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