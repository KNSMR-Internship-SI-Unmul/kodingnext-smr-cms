@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/students" class="hover:text-brand-blue-hover transition-colors">Students</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Student Details</span>
    </nav>
@endsection

@section('content')
<div x-data="{ 
        showStudentModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false,

        studentData: {
            name: @js(old('name', $student->name)),
            school: @js(old('school', $student->school)),
            phone_number: @js(old('phone_number', $student->phone_number)),
            address: @js(old('address', $student->address))
        },

        init() {
            @if($errors->any())
                setTimeout(() => {
                    this.showStudentModal = true;
                }, 100);
            @endif
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showStudentModal = false;
            @endif
        }
    }" 
    class="max-w-7xl mx-auto"
>
    
    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-black mb-1 tracking-tight">Student Details</h1>
            <p class="text-sm font-medium text-gray-500">Complete student information.</p>
        </div>
        <div class="flex items-center gap-4">
            <a href="/students" class="flex items-center text-brand-pink hover:text-brand-blue-hover transition-colors font-semibold text-sm group">
                <svg class="w-4 h-4 mr-1 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back
            </a>
            <button @click="showStudentModal = true" class="flex items-center justify-center px-6 py-2.5 w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-sm gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                Edit Data
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.8fr] gap-8">
        
        <div class="bg-brand-light-pink/75 rounded-2xl shadow shadow-brand-pink border-2 border-brand-pink flex flex-col relative h-max">
            <div class="absolute top-4 right-4 z-20">
                @if($student->is_profile_complete)
                    <span class="inline-block px-3 py-1.5 bg-brand-light-green text-brand-green border border-brand-green text-xs font-semibold rounded-full">
                        Profile Complete
                    </span>
                @else
                    <span class="inline-block px-3 py-1.5 bg-brand-light-yellow text-brand-yellow border border-brand-yellow text-xs font-semibold rounded-full">
                        Profile Incomplete
                    </span>
                @endif
            </div>
            
            <div class="flex pt-6 pb-6 px-6 items-center text-center shrink-0 min-h-[175px]">
                <h3 class="text-xl leading-tight font-bold text-brand-pink mx-auto max-w-[80%]">
                    {{ $student->name }} 
                </h3>
            </div>

            <div class="bg-white rounded-2xl rounded-t-3xl p-6 flex-1 flex flex-col mt-auto relative h-2/3">
                <div class="mb-6 min-h-[150px]">
                    <h4 class="text-sm font-bold text-brand-pink mb-2">Modules</h4>
                    <div class="flex flex-wrap gap-2 mb-1.5">
                        <span class="inline-block px-4 py-1.5 bg-brand-light-blue-active/75 text-brand-blue text-xs font-semibold rounded-full">
                            To Be Development
                        </span>
                    </div>
                </div>

                <div class="w-full mt-auto pt-6 border-t border-gray-100">
                    <button @click="showDeleteModal = true" class="w-full flex items-center justify-center gap-2 bg-[#FFF0F0] hover:bg-red-100 text-red-600 font-semibold py-3 rounded-xl transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Delete Student
                    </button>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-6">

            <div class="bg-white rounded-xl shadow shadow-brand-pink border-2 border-brand-pink p-8">
                <div class="flex items-center gap-3 mb-3">
                    <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    <h3 class="text-lg font-semibold text-brand-pink">General Information</h3>
                </div>

                <div class="grid grid-cols-2 gap-y-3 gap-x-12">
                    <div>
                        <p class="text-sm font-medium text-brand-pink mb-1">Full Name</p>
                        <p class="text-base font-semibold text-gray-900 leading-snug">{{ $student->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-pink mb-1">Phone Number</p>
                        <p class="text-base font-semibold text-gray-900">{{ $student->phone_number ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-pink mb-1">School</p>
                        <p class="text-base font-semibold text-gray-900">{{ $student->school ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-brand-pink mb-1">Address</p>
                        <p class="text-base font-semibold text-gray-900">{{ $student->address ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow shadow-brand-pink border-2 border-brand-pink p-8">
                <div class="flex items-center gap-3 mb-3">
                    <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                    <h3 class="text-lg font-semibold text-brand-pink">Student Projects</h3>
                </div>
                
                {{-- <div class="flex flex-wrap gap-4 w-full">
                    <span class="flex-1 bg-brand-light-blue-active/75 text-brand-blue font-semibold px-8 py-3 rounded-lg text-sm text-center">
                        Anomaly Website
                    </span>
                    <span class="flex-1 bg-brand-light-blue-active/75 text-brand-blue font-semibold px-8 py-3 rounded-lg text-sm text-center">
                        Calculator
                    </span>
                    <span class="flex-1 bg-brand-light-pink-active/75 text-brand-pink font-semibold px-8 py-3 rounded-lg text-sm text-center">
                        Flapping Bird
                    </span>
                </div> --}}

                {{-- empty state --}}
                <div class="bg-gray-100 rounded-xl p-4 flex items-center gap-3 border border-gray-200">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    <span class="text-gray-500 font-bold text-sm">No projects yet</span>
                </div>

                <div class="flex items-center gap-3 mb-3 mt-8">
                    <svg class="w-5 h-5 text-brand-pink" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="text-lg font-semibold text-brand-pink">System Information</h3>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-light-pink flex items-center justify-center text-brand-pink">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-brand-pink font-medium mb-0.5">Created on</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $student->created_at->format('d F Y') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-xl bg-brand-light-pink flex items-center justify-center text-brand-pink">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-brand-pink font-medium mb-0.5">Last updated</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $student->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- edit student modal --}}
    <div x-show="showStudentModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Student Information</h2>

            <form action="{{ route('students.update', $student->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="student_id" x-model="studentData.id">
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-800">Name</label>
                        <input type="text" name="name" x-model="studentData.name" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                        @error('name')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-800">School</label>
                        <input type="text" name="school" x-model="studentData.school" required class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('school') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                        @error('school')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-800">Phone Number</label>
                        <input type="text" name="phone_number" x-model="studentData.phone_number" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('phone_number') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror">
                        @error('phone_number')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold mb-1 text-gray-800">Address</label>
                        <textarea name="address" rows="4" x-model="studentData.address" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('address') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror"></textarea>
                        @error('address')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-3 pt-1 justify-end">
                        <button type="button" @click="closeEditModal()" class="py-2.5 w-1/4 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition text-sm">Cancel</button>
                        <button type="submit" class="py-2.5 w-1/4 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-sm">Save</button>
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
            
            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Student?</h3>
            <p class="text-sm text-gray-600 mb-4 font-medium">Are you sure you want to delete this student? This action cannot be undone.</p>
            
            <div class="bg-red-50 border border-red-100 rounded-lg p-3.5 mb-6 text-left">
                <p class="text-xs font-bold text-red-800 mb-1.5 flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    This will permanently remove:
                </p>
                <ul class="text-xs text-red-700 list-disc list-inside ml-1 space-y-1 font-medium">
                    <li>Student's profile</li>
                    <li>All submitted Student Projects</li>
                    <li>All associated Project Reviews</li>
                </ul>
            </div>
            
            <div class="flex gap-3">
                <button @click="showDeleteModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="flex-1">
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