@extends('layouts.app')

@section('header_title')
    <nav class="flex items-center text-sm font-medium text-gray-500">
        <a href="/employees" class="hover:text-brand-blue-hover transition-colors">Employees</a>
        <span class="mx-2">›</span>
        <span class="text-brand-pink">Roles</span>
    </nav>
@endsection

@section('content')
<div x-data="{ 
        showRoleModal: {{ $errors->any() ? 'true' : 'false' }},
        showDeleteModal: false,
        editMode: {{ old('role_id') ? 'true' : 'false' }},
        actionUrl: '{{ route('roles.store') }}',
        
        roleData: {
                id: @js(old('id', '')),
                name: @js(old('name', ''))
            },
        
        openEditModal(role) {
            this.editMode = true;
            this.roleData = { ...role };
            this.actionUrl = `/employees/roles/${role.id}`;
            this.showRoleModal = true;
        },
        
        openDeleteModal(roleId) {
            this.actionUrl = `/employees/roles/${roleId}`;
            this.showDeleteModal = true;
        },

        closeEditModal() {
            @if($errors->any())
                window.location.href = window.location.href;
            @else
                this.showRoleModal = false;
            @endif
        },

        resetModal() {
            this.editMode = false;
            this.actionUrl = '{{ route('roles.store') }}';
            this.roleData = { id: '', name: '' };
            this.showRoleModal = true;
        }
    }" 
    class="max-w-7xl mx-auto"
>

    <div class="flex justify-between items-end mb-8">
        <div>
            <h1 class="text-3xl font-bold text-brand-pink mb-1 tracking-tight">Roles</h1>
            <p class="text-sm font-medium text-gray-500">Manage employee roles.</p>
        </div>
        <button @click="resetModal()" class="px-6 py-2.5 w-[180px] h-[42px] bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition shadow-sm text-sm">
            + Add Role
        </button>
    </div>

    {{-- role table --}}
    <div class="bg-white rounded-xl border border-gray-100 overflow-hidden mb-4">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="h-12 border-b border-gray-100 bg-brand-light-blue">
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap w-16 text-center">No.</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap">Role Name</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap text-center">Total Users</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue whitespace-nowrap text-center">Created At</th>
                        <th class="py-3 px-4 text-sm font-bold text-brand-blue text-center whitespace-nowrap w-32">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr class="border-b border-gray-50 hover:bg-brand-light-blue-active transition-colors bg-brand-light-blue-active/75">
                            <td class="py-3 px-4 text-center font-semibold text-gray-900 text-sm">{{ $loop->iteration }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-6 h-6 rounded bg-brand-light-pink text-brand-pink font-bold flex items-center justify-center text-xs shadow-sm">
                                        {{ $role->initials }}
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm">{{ $role->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">{{ $role->users->count() }} User</td>
                            <td class="py-3 px-4 text-center font-medium text-gray-500 text-sm">{{ $role->created_at->format('d F Y') }}</td>
                            <td class="py-3 px-4">
                                <div class="flex items-center justify-center gap-3">
                                    <button @click="openEditModal({{ json_encode($role) }})" class="text-brand-pink hover:text-brand-pink-hover transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    </button>
                                    <button @click="openDeleteModal({{ $role->id }})" class="text-red-500 hover:text-red-600 transition-colors" title="Delete">
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

    {{-- create & edit role modal --}}
    <div x-show="showRoleModal" style="display: none;" class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
        <div @click.away="closeEditModal()" class="bg-white rounded-lg p-8 w-full max-w-2xl shadow-2xl relative overflow-hidden" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            
            <button @click="closeEditModal()" class="absolute top-6 right-6 text-gray-400 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h2 class="text-2xl font-extrabold text-gray-900 mb-8">Role Information</h2>

            <form :action="actionUrl" method="POST" class="space-y-5">
                @csrf
                <input type="hidden" name="_method" value="PUT" x-bind:disabled="!editMode">
                <div>
                    <label class="block text-sm font-semibold mb-1 text-gray-800">Role Name</label>
                    <input type="text" name="name" x-model="roleData.name" class="w-full px-4 py-2 text-sm rounded-lg border focus:outline-none focus:ring-2 focus:ring-brand-pink transition @error('name') border-red-500 focus:border-gray-300 @else border-gray-300 @enderror" placeholder="e.g. Teacher" required>
                    @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex gap-3 pt-3 justify-end">
                    <button type="button" @click="closeEditModal()" class="py-2.5 w-1/4 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition text-sm">Cancel</button>
                    <button type="submit" class="py-2.5 w-1/4 bg-brand-light-pink text-brand-pink hover:bg-brand-pink hover:text-white font-semibold rounded-lg transition text-sm">Save</button>
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

            <h3 class="text-xl font-extrabold text-gray-900 mb-2">Delete Role?</h3>
            <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure you want to delete this role? Users assigned to this role might lose access.</p>
            
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