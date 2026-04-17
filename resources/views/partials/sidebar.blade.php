<aside class="w-[260px] bg-white border-r border-gray-100 flex flex-col h-screen shadow-sm z-10 relative transition-all duration-300">

    <div class="px-6 py-8 flex justify-center">
        <a href="/dashboard">
            <img src="{{ asset('images/knsmr-icon.png') }}" alt="Logo Koding Next" class="h-8 w-auto">
        </a>
    </div>

    <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto pb-4 custom-scrollbar">
        
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-2.5 text-sm font-semibold text-brand-blue bg-brand-light-blue-hover rounded-full transition-all">
            <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        <a href="/modules" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path></svg>
            Modules
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Student Projects
        </a>

        <a href="/events" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Events
        </a>

        <a href="/promotions" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            Promotions
        </a>

        {{-- section human resources --}}
        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-semibold text-gray-400 tracking-wider uppercase">Human Resources</p>
        </div>

        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14v7"></path></svg>
            Students
        </a>

        <a href="/employees" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-gray-500 rounded-full hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Employees
        </a>

        {{-- section system --}}
        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-semibold text-gray-400 tracking-wider uppercase">System</p>
        </div>

        <a href="#" class="flex items-center gap-3 px-4 py-2.5 text-sm font-medium text-red-500 rounded-full hover:bg-red-50 hover:text-red-600 transition-all group">
            <svg class="w-5 h-5 text-red-400 group-hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout
        </a>

    </nav>

    {{-- user profile --}}
    <div class="p-4 border-t border-gray-100 bg-white">
        <div class="flex items-center gap-3 w-full cursor-pointer hover:bg-gray-50 p-2 rounded-xl transition-colors">
            
            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border border-gray-200 flex-shrink-0 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
            
            <div class="flex-1 overflow-hidden">
                <p class="text-[11px] text-gray-400 font-medium truncate">Student Advisor</p>
                <p class="text-sm font-bold text-gray-900 truncate tracking-tight">Rinda Lailatul Arofah, S.Kom.</p>
            </div>
            
            <svg class="w-4 h-4 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </div>
    </div>
</aside>
