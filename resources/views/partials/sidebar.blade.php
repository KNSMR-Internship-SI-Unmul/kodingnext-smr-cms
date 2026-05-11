<aside x-data="{ showLogoutModal: false}" class="max-w-64 bg-white border-r border-gray-100 flex flex-col h-screen shadow-sm z-10 relative transition-all duration-300">

    <div class="px-6 py-8 flex justify-center">
        <a href="/dashboard">
            <img src="{{ asset('images/knsmr-icon.png') }}" alt="Logo Koding Next" class="h-8 w-auto">
        </a>
    </div>

    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto pb-4 custom-scrollbar">
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('dashboard*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('dashboard*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        <a href="/modules" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('modules*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('modules*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
            Modules
        </a>

        <a href="/student-projects" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('student-projects*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('student-projects*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Student Projects
        </a>

        <a href="/events" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('events*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('events*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Events
        </a>

        <a href="/promotions" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('promotions*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('promotions*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            Promotions
        </a>

        <a href="/general-testimonials" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('general-testimonials*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('general-testimonials*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"></path></svg>
            General Testimonials
        </a>

        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-semibold text-gray-400 tracking-wider uppercase">Human Resources</p>
        </div>

        <a href="/students" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('students*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('students*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"></path></svg>
            Students
        </a>

        <a href="/employees" class="flex items-center gap-3 px-4 py-2.5 text-sm rounded-full transition-all group
            {{ request()->is('employees*') 
                ? 'font-semibold text-brand-blue bg-brand-light-blue-hover' 
                : 'font-medium text-gray-500 hover:bg-gray-50 hover:text-gray-800' }}">
            <svg class="w-5 h-5 {{ request()->is('employees*') ? 'text-brand-blue' : 'text-gray-400 group-hover:text-gray-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Employees
        </a>

        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-semibold text-gray-400 tracking-wider uppercase">System</p>
        </div>

        <button type="button" @click="showLogoutModal = true" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-500 rounded-full hover:bg-red-50 hover:text-red-600 transition-all group">
            <svg class="w-5 h-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout
        </button>
    </nav>

    <div class="p-4 border-t border-gray-100 bg-white">
        <a href="/employees/{{ auth()->id() }}" class="flex items-center gap-3 w-full cursor-pointer hover:bg-gray-50 p-2 rounded-xl transition-colors">
            
            <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=3D7D9E&background=EEF6FB' }}" 
                 alt="{{ auth()->user()->name }}'s Profile Picture" 
                 class="w-10 h-10 rounded-full object-cover border border-gray-200 flex-shrink-0">
            
            <div class="flex-1 overflow-hidden">
                <p class="text-[11px] text-gray-400 font-medium truncate">
                    {{ auth()->user()->role->name ?? 'Employee' }}
                </p>
                
                <p class="text-sm font-bold text-gray-900 truncate tracking-tight group-hover:text-brand-pink transition-colors">
                    {{ auth()->user()->name }}
                </p>
            </div>
            
            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </a>
    </div>

    {{-- logout confirm modal --}}
    <template x-teleport="body">
        <div x-show="showLogoutModal" style="display: none;" class="fixed inset-0 z-[9999] flex items-center justify-center bg-gray-900/40 backdrop-blur-sm" x-transition.opacity>
            <div @click.away="showLogoutModal = false" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-2xl relative overflow-hidden text-center" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100">
                
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4 text-red-500 shadow-sm">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15"></path></svg>
                </div>
                
                <h3 class="text-xl font-extrabold text-gray-900 mb-2">Logout Account?</h3>
                <p class="text-sm text-gray-500 mb-6 font-medium">Are you sure want to logout your account?</p>
                
                <div class="flex gap-3">
                    <button type="button" @click="showLogoutModal = false" class="flex-1 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-lg transition">Cancel</button>
                    
                    <form action="{{ route('logout') }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" class="w-full py-2.5 bg-[#EE5B5B] hover:bg-red-600 text-white font-semibold rounded-lg transition">Yes, logout</button>
                    </form>
                </div>
                
            </div>
        </div>
    </template>

</aside>