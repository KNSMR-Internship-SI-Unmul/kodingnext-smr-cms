@props(['type' => 'success', 'message'])

@php
    $styles = [
        'welcome' => [
            'wrapper' => 'bg-[#FCEEF5] justify-center',
            'text'    => 'text-[#E4559B]',
            'border'  => 'border-[#E4559B]',
            'icon_bg' => 'hidden',
            'icon'    => '',
        ],
        'success' => [
            'wrapper' => 'bg-[#E8F6ED]',
            'text'    => 'text-[#16A34A]',
            'border'  => 'border-[#16A34A]',
            'icon_bg' => 'bg-[#B7E2C7] text-[#16A34A]',
            'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>',
        ],
        'delete' => [
            'wrapper' => 'bg-[#FEF2F2]',
            'text'    => 'text-[#FF383C]',
            'border'  => 'border-[#FF383C]',
            'icon_bg' => 'bg-[#FEE2E2] text-[#FF383C]',
            'icon'    => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>',
        ],
    ];

    $style = $styles[$type] ?? $styles['success'];
@endphp

<div x-data="{ show: true }" 
    x-show="show" 
    x-init="setTimeout(() => show = false, 3000)" 
    x-transition.duration.500ms
    class="flex items-center gap-3 px-6 py-3 rounded-2xl w-full max-w-sm {{ $style['wrapper'] }} border-2 {{ $style['border'] }}">
    
    @if($type !== 'welcome')
        <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0 {{ $style['icon_bg'] }}">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $style['icon'] !!}
            </svg>
        </div>
    @endif

    <p class="text-base font-semibold {{ $style['text'] }} {{ $type === 'welcome' ? 'text-center w-full' : '' }}">
        {{ $message }}
    </p>
</div>