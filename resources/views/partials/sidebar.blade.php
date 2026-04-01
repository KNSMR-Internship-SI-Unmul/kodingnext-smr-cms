<aside class="w-64 bg-white border-r border-gray-100 flex flex-col h-full shadow-sm z-10 relative">
    
    <div class="px-6 py-5">
        <a href="/dashboard">
            <img src="{{ asset('images/knsmr-sidebar-icon.svg') }}" alt="Logo Koding Next" class="h-13 w-auto">
        </a>
    </div>

    <nav class="flex-1 px-4 space-y-1 overflow-y-auto">
        
        <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-500 rounded-3xl hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            Dashboard
        </a>

        <a href="/modules" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-500 rounded-3xl hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
            Modules
        </a>

        <a href="/employees" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-500 rounded-3xl hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            Employees
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-500 rounded-3xl hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            Student Projects
        </a>

        <a href="#" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-500 rounded-3xl hover:bg-gray-50 hover:text-gray-800 transition-all group">
            <svg class="w-5 h-5 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            Events
        </a>

        <a href="/promotions" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-[#51A7D3] bg-[#E5F2F8] rounded-3xl transition-all shadow-sm">
            <svg class="w-5 h-5 text-[#51A7D3]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path></svg>
            Promotions
        </a>

    </nav>

    <div class="p-6 border-t border-gray-100 flex flex-col gap-6">
        
        <a href="#" class="flex items-center gap-3 px-3 py-2 text-sm font-semibold text-red-500 hover:text-red-600 hover:bg-red-100 rounded-3xl transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Logout
        </a>

        <div class="flex items-center gap-3 w-full cursor-pointer hover:bg-gray-50 p-2 -mx-2 rounded-3xl transition-colors">
            <div class="w-10 h-10 rounded-full bg-gray-200 overflow-hidden border border-gray-300">
                <svg class="w-full h-full text-gray-400 mt-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
            </div>
            <div class="flex-1 overflow-hidden">
                <p class="text-xs text-gray-500 truncate">Student Advisor</p>
                <p class="text-sm font-bold text-gray-800 truncate">Rinda Lailatul Arofah S.Kom.</p>
            </div>
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
        </div>
    </div>
</aside>