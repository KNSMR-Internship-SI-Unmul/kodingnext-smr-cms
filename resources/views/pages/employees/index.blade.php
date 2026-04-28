@extends('layouts.app')

@section('header_title', 'Employees')

@section('content')
<div x-data="{ 
        showEmployeeModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false,
        editMode: {{ old('employee_id') ? 'true' : 'false' }},
        actionUrl: '{{ route('employees.store') }}',
        
        employeeData: { 
            id: @js(old('employee_id', '')),
            name: @js(old('name', '')),
            email: @js(old('email', '')),
            phone_number: @js(old('phone_number', '')),
            profile_picture: '',
            hired_date: @js(old('hired_date', '')),
            role_id: @js(old('role_id', '')) 
        },

        openEditModal(employee) {
            this.editMode = true;
            this.employeeData = { ...employee, profile_picture: '' };
            this.actionUrl = `/employees/${employee.id}`;
            this.showEmployeeModal = true;
        },

        openDeleteModal(employeeId) {
            this.actionUrl = `/employees/${employeeId}`;
            this.showDeleteModal = true;
        },

        init() {
            if (this.employeeData.id) {
                this.actionUrl = `/employees/${this.employeeData.id}`;
            }
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showEmployeeModal = false;
            @endif
        },

        resetModal() {
            this.editMode = false;
            this.actionUrl = '{{ route('employees.store') }}';
            this.employeeData = { id: '', name: '', email: '', phone_number: '', profile_picture: '', hired_date: '', role_id: '' };
            this.showEmployeeModal = true;
        }
    }" 
    class="max-w-7xl mx-auto"
>

    <div class="mb-8 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" placeholder="Search user by name" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
    </div>

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
            <span class="text-brand-pink">{{ $employees->count() }}</span> Employee
        </h1>
        <div class="flex gap-4">
            <a href="/employees/roles" class="px-6 py-2.5 h-[42px] gap-2 bg-brand-white hover:bg-brand-pink text-brand-pink hover:text-white border border-brand-pink font-semibold rounded-lg transition text-sm flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z"></path></svg>
                Manage Roles
            </a>
            
            <button @click="resetModal()" class="px-6 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm flex items-center justify-center">
                + Add Employee
            </button>
        </div>
    </div>

    @if($employees->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No employees yet" 
                description="No employee data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first employee
                </button>
            </x-empty-state>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($employees as $employee)
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md overflow-hidden flex flex-col h-full group relative transition-all duration-300 hover:-translate-y-1 border border-gray-100">
                <div class="relative h-56 w-full bg-gray-100">
                    <div class="absolute top-4 right-4 z-20" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" class="text-brand-blue hover:text-brand-blue-hover focus:outline-none transition-colors rounded-full p-1 hover:bg-brand-blue/10">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z"></path></svg>
                        </button>   
                        
                        <div  
                            x-show="openDropdown" 
                            @click.away="openDropdown = false"
                            style="display: none;"
                            class="absolute right-0 mt-1 w-36 bg-white rounded-xl shadow-xl border border-gray-100 z-30 overflow-hidden"
                            x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                        >
                            <button @click="openDropdown = false; openEditModal({{ json_encode($employee) }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-blue flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Edit
                            </button>
                            <button @click="openDropdown = false; openDeleteModal({{ $employee->id }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors border-t border-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </div>
                    </div>

                    <img src="{{ $employee->profile_picture ? asset('storage/' . $employee->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&color=3D7D9E&background=EEF6FB' }}" alt="Profile Picture" class="w-full h-full object-cover">
                    
                    <div class="absolute bottom-0 left-0 right-0 p-5 bg-gradient-to-t from-brand-blue/90 via-brand-blue/40 to-transparent pt-12">
                        <h3 class="font-bold text-white text-md leading-tight mb-0.5">{{ $employee->name }}</h3>
                    </div>
                </div>

                <div class="p-5 flex-1 flex flex-col">
                    <div class="flex justify-between items-center mb-3">
                        <div>
                            <p class="text-xs text-gray-400 font-medium mb-1">Role</p>
                            <p class="text-sm font-bold text-brand-blue">{{ $employee->role->name ?? 'No Role' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-400 font-medium mb-1">Hired Date</p>
                            <p class="text-sm font-bold text-gray-900">{{ $employee->hired_date ? $employee->hired_date->format('d/m/Y') : '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-auto text-center">
                        <a href="/employees/{{ $employee->id }}" class="block text-sm font-medium h-full w-full text-gray-700 hover:text-brand-blue hover:bg-gray-50 rounded-lg py-2 transition-colors">
                            View Details
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div> 
    @endif

    {{-- create & edit employee modal --}}
    <div x-show="showEmployeeModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-4xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Employee Information</h2>

            <form :action="actionUrl" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
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
                                <input type="password" name="password" x-model="employeeData.password" :required="!editMode" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('password') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
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
                <form :action="actionUrl" method="POST" class="flex-1">
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