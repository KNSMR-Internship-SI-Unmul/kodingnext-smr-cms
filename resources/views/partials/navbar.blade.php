<header class="h-20 bg-white/80 backdrop-blur-md border-b border-gray-100 flex items-center justify-between px-9 sticky top-0 z-10">
    
    <div>
        <h2 class="text-2xl font-bold text-brand-pink tracking-tight">
            @yield('header_title', 'Dashboard')
        </h2>
    </div>

    <a href="/employees/{{ auth()->id() }}" class="flex items-center gap-3 border border-brand-pink rounded-lg px-3 py-1 cursor-pointer hover:bg-gray-100 transition-colors shadow-sm">
        
        <div class="text-right">
            <p class="text-xs font-semibold text-gray-900 leading-tight">{{ auth()->user()->role->name ?? 'Employee' }}</p>
            <p class="text-[10px] font-medium text-gray-600">{{ auth()->user()->name }}</p>
        </div>
        
        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&color=3D7D9E&background=EEF6FB' }}" 
                 alt="{{ auth()->user()->name }}'s Profile Picture" 
                 class="h-8 w-8 rounded-full bg-gray-200 border border-gray-200 object-cover items-center justify-center">
    </a>
    
</header>