@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="w-full max-w-5xl flex flex-col md:flex-row items-center justify-between gap-12 lg:gap-24 z-10">

    <div class="flex-1 flex flex-col items-center text-center">
        <img src="{{ asset('images/knsmr-icon.png') }}" alt="Koding Next Logo" class="h-14 lg:h-16 mb-4">
        <h1 class="text-2xl lg:text-[28px] font-semibold text-brand-blue tracking-tight">Content Management System</h1>
    </div>

    <div class="flex-[1.2] w-full max-w-md">
        <div class="bg-white rounded-lg p-10 shadow-md relative z-10">
            
            <h2 class="text-3xl font-semibold text-brand-pink text-center mb-10">Welcome!</h2>

            <form action="#" method="POST" class="space-y-5">
                @csrf
                
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Email Address</label>
                    <input type="email" name="email" placeholder="name@example.com" required 
                        class="w-full px-4 py-3.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink text-gray-700 placeholder-gray-400 transition-all text-sm">
                </div>

                <div x-data="{ showPassword: false }">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'" name="password" placeholder="Password" required 
                            class="w-full px-4 py-3.5 pr-12 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink text-gray-700 placeholder-gray-400 transition-all text-sm">

                        <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-brand-pink transition-colors focus:outline-none">
                            
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            
                            <svg x-show="showPassword" style="display: none;" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex justify-end mt-3">
                        <a href="#" class="text-xs font-medium text-gray-600 hover:text-red-700 transition-colors">Forgot password?</a>
                    </div>
                </div>

                <div class="pt-2 text-center">
                    <button type="submit" class="w-full py-2.5 bg-brand-pink hover:bg-brand-pink-hover text-white font-semibold rounded-lg transition text-lg">
                        Log In
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection