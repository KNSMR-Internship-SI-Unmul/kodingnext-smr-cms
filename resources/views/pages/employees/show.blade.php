@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/employees" class="hover:text-brand-blue-hover transition-colors">Employees</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Employee Details</span>
    </nav>
@endsection

@section('content')
<div x-data="{
        showEmployeeModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false,
        
        employeeData: { 
            name: @js(old('name', $employee->name)),
            email: @js(old('email', $employee->email)),
            phone_number: @js(old('phone_number', $employee->phone_number)),
            password: '',
            profile_picture: '',
            hired_date: @js(old("hired_date", $employee->hired_date ? $employee->hired_date->format("Y-m-d") : "")),
            role_id: @js(old("role_id", $employee->role_id))
        },

        init() {
            @if($errors->any())
                setTimeout(() => {
                    this.showEmployeeModal = true;
                }, 100);
            @endif
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showEmployeeModal = false;
            @endif
        }
    }" 
    class="max-w-7xl mx-auto">

    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-black mb-1 tracking-tight">Employees Details</h1>
            <p class="text-sm font-medium text-gray-500">Complete employee information.</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/employees" class="flex items-center text-brand-pink hover:text-brand-blue-hover transition-colors font-semibold text-sm group">
                <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </a>
            <button @click="showEmployeeModal = true" class="flex items-center justify-center px-6 py-2.5 w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.8fr] gap-6">
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
            <div class="h-64 w-full bg-gray-100 relative">
                <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&color=3D7D9E&background=EEF6FB' }}" alt="Profile Picture" class="w-full h-full object-cover">
            </div>
                
            <div class="p-6 flex flex-col items-center flex-1">
                <h2 class="text-xl font-semibold text-gray-900 mb-6 text-center">{{ $employee->name }}</h2>
                
                <div class="bg-brand-light-blue-active text-brand-dark-blue font-semibold px-8 py-2.5 rounded-full text-base mb-6 w-max-[250px] text-center">
                    {{ $employee->role->name ?? 'No Role' }}
                </div>
                
                <div class="w-full mt-auto pt-6 border-t border-gray-100">
                    <button @click="showDeleteModal = true" class="w-full flex items-center justify-center gap-2 bg-[#FFF0F0] hover:bg-red-100 text-red-600 font-semibold py-3 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete Employee
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6">
            <div class="bg-white rounded-xl shadow shadow-brand-blue border-2 border-brand-blue p-8">
                <div class="flex items-center gap-3 mb-3">
                    <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <h3 class="text-lg font-semibold text-brand-blue">General Information</h3>
                </div>

                <div class="grid grid-cols-[2fr_1fr] gap-y-3 gap-x-12">
                    <div>
                            <p class="text-sm font-medium text-brand-blue mb-1">Full Name</p>
                            <p class="text-base font-semibold text-gray-900 leading-snug">{{ $employee->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-blue mb-1">Hired Date</p>
                        <p class="text-base font-semibold text-gray-900">{{ $employee->hired_date ? $employee->hired_date->format('d F Y') : '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-blue mb-1">Email</p>
                        <p class="text-base font-semibold text-gray-900">{{ $employee->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-blue mb-1">Phone Number</p>
                        <p class="text-base font-semibold text-gray-900">{{ $employee->phone_number ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow shadow-brand-blue border-2 border-brand-blue p-8">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-lg font-semibold text-brand-blue">System Information</h3>
                    </div>
                    
                    <div class="grid grid-cols-[2fr_1fr] gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-light-blue-active flex items-center justify-center text-brand-blue-hover">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-brand-blue font-medium mb-0.5">Created on</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $employee->created_at->format('d F Y') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-xl bg-brand-light-blue-active flex items-center justify-center text-brand-blue-hover">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-xs text-brand-blue font-medium mb-0.5">Last updated</p>
                                <p class="text-sm font-semibold text-gray-900">{{ $employee->updated_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- edit employee modal --}}
    <div x-show="showEmployeeModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Employee Information</h2>

            <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="employee_id" x-model="employeeData.id">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <div class="space-y-5">
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Name</label>
                            <input type="text" name="name" x-model="employeeData.name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Hired Date</label>
                            <input type="date" name="hired_date" x-model="employeeData.hired_date" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('hired_date') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                            @error('hired_date')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Phone Number</label>
                            <input type="text" name="phone_number" x-model="employeeData.phone_number" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('phone_number') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">    
                            @error('phone_number')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-800">Email</label>
                                <input type="email" name="email" x-model="employeeData.email" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('email') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                @error('email')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-1 text-gray-800">Password</label>
                                <input type="password" name="password" x-model="employeeData.password" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('password') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                                @error('password')
                                    <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>     

                        <div>
                            <label class="block text-sm font-semibold mb-1 text-gray-800">Role</label>
                            <select name="role_id" x-model="employeeData.role_id" required class="w-full px-4 py-2 text-sm rounded-lg border border-gray-300 focus:outline-none focus:ring-2 transition bg-white focus:ring-brand-pink">
                                <option value="" disabled selected>Select Role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="flex flex-col h-full" x-data="{ fileName: null }">
                        <label class="block text-xl font-semibold text-gray-800 mb-3">Profile Picture</label>
                        
                        <div class="flex-1 min-h-[250px] flex flex-col items-center justify-center bg-brand-light-pink rounded-lg cursor-pointer transition relative hover:opacity-90">
                            <input type="file" 
                                name="profile_picture" 
                                accept="image/*"
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
                                    <p class="text-xs font-medium text-gray-500">PNG, JPG, JPEG up to 2MB</p>
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

                        @error('profile_picture')
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
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Employee?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to remove this employee data? This action cannot be undone.</p>
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, delete</button>
                </form>
            </div>
        </div>
    </div>

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