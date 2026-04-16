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

                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Password</label>
                    <input type="password" name="password" placeholder="Password" required 
                        class="w-full px-4 py-3.5 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-brand-pink text-gray-700 placeholder-gray-400 transition-all text-sm">

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