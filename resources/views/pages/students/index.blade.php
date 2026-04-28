@extends('layouts.app')

@section('header_title', 'Students')

@section('content')
<div x-data="{ 
        showStudentModal: {{ $errors->any() ? 'true' : 'false' }}, 
        showDeleteModal: false,
        editMode: {{ old('student_id') ? 'true' : 'false' }},
        actionUrl: '{{ route('students.store') }}',
        
        studentData: { 
            id: @js(old('student_id', '')),
            name: @js(old('name', '')), 
            school: @js(old('school', '')),
            phone_number: @js(old('phone_number', '')),
            address: @js(old('address', ''))
        },
        
        openEditModal(student) {
            this.editMode = true;
            this.studentData = { ...student, is_profile_complete: student.is_profile_complete == 1 };
            this.actionUrl = `/students/${student.id}`;
            this.showStudentModal = true;
        },
        
        openDeleteModal(studentId) {
            this.actionUrl = `/students/${studentId}`;
            this.showDeleteModal = true;
        },

        init() {
            if (this.studentData.id) {
                this.actionUrl = `/students/${this.studentData.id}`;
            }
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showStudentModal = false;
            @endif
        },

        resetModal() {
            this.editMode = false;
            this.actionUrl = '{{ route('students.store') }}';
            this.studentData = { id: '', name: '', school: '', phone_number: '', address: '' };
            this.showStudentModal = true;
        }
    }"
    class="max-w-7xl mx-auto"
>

    <div class="mb-8 relative">
        <span class="absolute inset-y-0 left-0 flex items-center pl-4">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </span>
        <input type="text" placeholder="Search student by name" class="w-full pl-12 pr-4 py-2.5 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-brand-pink transition text-sm">
    </div>

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
            <span class="text-brand-pink">{{ $students->count() }}</span> Student
        </h1>
        <div class="flex gap-4">
            <button @click="resetModal()" class="px-6 py-2.5 h-[42px] w-[180px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm flex items-center justify-center gap-2">
                + Add Student
            </button>
        </div>
    </div>

    @if($students->isEmpty())
        <div class="w-full">
            <x-empty-state 
                title="No students yet" 
                description="No student data available yet."
            >
                <x-slot name="icon">
                    <svg class="w-10 h-10 text-brand-yellow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"></path></svg>
                </x-slot>

                <button @click="resetModal()" class="px-8 py-3 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
                    Add your first student
                </button>
            </x-empty-state>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($students as $student)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md border border-gray-200 overflow-hidden flex flex-col h-full relative transition-all duration-300 hover:-translate-y-1">
                    <div class="absolute top-4 right-4 z-20" x-data="{ openDropdown: false }">
                        <button @click="openDropdown = !openDropdown" class="text-brand-pink hover:text-brand-pink focus:outline-none transition-colors rounded-full p-2 hover:bg-brand-pink/10">
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
                            <button @click="openDropdown = false; openEditModal({{ json_encode($student) }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-brand-pink flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                Edit
                            </button>
                            <button @click="openDropdown = false; openDeleteModal({{ $student->id }})" class="w-full text-left px-4 py-2.5 text-sm font-semibold text-red-600 hover:bg-red-50 flex items-center gap-2 transition-colors border-t border-gray-100">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                Delete
                            </button>
                        </div>
                    </div>

                    <div class="flex pt-6 pb-6 px-6 items-center text-center shrink-0 min-h-[140px]">
                        <h3 class="text-xl leading-tight font-bold text-brand-pink mx-auto max-w-[80%]">
                            {{ $student->name }}
                        </h3>
                    </div>

                    <div class="bg-brand-light-pink/75 rounded-2xl rounded-t-3xl p-6 flex-1 flex flex-col mt-auto relative h-2/3">
                        <div class="mb-4">
                            <h4 class="text-sm font-bold text-brand-pink mb-1">Modules</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="inline-block px-4 py-1.5 bg-brand-light-blue-active/75 text-brand-blue text-xs font-semibold rounded-full">
                                    To Be Development
                                </span>
                            </div>
                        </div>

                        <div class="flex justify-between mb-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 mb-1">Project</p>
                                <p class="text-sm font-bold text-brand-pink">{{ $student->studentProjects->count() }} Project</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs font-medium text-gray-500 mb-1">Review</p>
                                <p class="text-sm font-bold text-brand-pink">0 review</p>
                            </div>
                        </div>

                        <div class="text-center">
                            <a href="/students/{{ $student->id }}" class="block text-sm font-medium h-full w-full text-gray-700 hover:text-brand-pink hover:bg-brand-light-pink-hover rounded-lg py-2 transition-colors">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
     
    {{-- create & edit student modal --}}
    <div x-show="showStudentModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden max-h-[90vh] overflow-y-auto" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Student Information</h2>

            <form :action="actionUrl" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
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