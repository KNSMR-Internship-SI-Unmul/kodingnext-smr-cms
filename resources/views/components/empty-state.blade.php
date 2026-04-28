@props(['title', 'description', 'icon' => null])

<div class="bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col items-center justify-center min-h-[500px] p-8 w-full">
    
    <div class="w-20 h-20 bg-brand-light-yellow rounded-full flex items-center justify-center mb-6 shadow-sm">
        @if($icon)
            {{-- Jika ada icon khusus yang dikirim, tampilkan --}}
            {{ $icon }}
        @else
            {{-- Jika tidak ada, tampilkan icon bintang default --}}
            <svg class="w-10 h-10 text-brand-yellow" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
        @endif
    </div>

    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $title }}</h2>
    <p class="text-md text-gray-500 font-medium mb-8 text-center">{{ $description }}</p>

    {{-- $slot adalah tempat tombol / konten tambahan disisipkan dari luar --}}
    {{ $slot }}

</div>