@extends('layouts.app')

<head>
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-blue-50 via-gray-50 to-purple-50 p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-2xl overflow-hidden relative z-10 transform transition-all animate-fade-up">
        <!-- Decorative elements -->
        <div class="absolute -top-20 -right-20 w-40 h-40 bg-blue-400 rounded-full opacity-10"></div>
        <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-purple-400 rounded-full opacity-10"></div>
        
        <div class="pt-10 pb-8 px-8 flex flex-col items-center">
            <!-- Logo Sekolah dengan animasi bounce -->
            <div class="rounded-full bg-gray-50 p-2 shadow-md mb-6 animate-bounce-in">
                <img src="{{ asset('storage/image/download.jpeg') }}" alt="Logo Sekolah" class="w-25 h-25 rounded-full object-cover animate-pulse-subtle">
            </div>
            
            <!-- Judul dengan animasi -->
            <h1 class="text-3xl font-bold mb-2 text-gray-800 text-center animate-slide-in transition-all">Selamat Datang</h1>
            <h2 class="text-xl font-medium text-blue-600 mb-8 animate-slide-in-delayed transition-all">Metschoo-Canteen</h2>
            
            <!-- Garis pemisah dengan animasi -->
            <div class="w-16 h-1 bg-gradient-to-r from-blue-500 to-purple-500 rounded mb-8 animate-expand"></div>
            
            <!-- Kotak Pilihan Login dengan animasi -->
            <div class="flex flex-col space-y-4 w-full">
                <a href="{{ route('filament.admin.auth.login') }}" 
                   class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-xl flex items-center justify-center font-medium hover:from-blue-700 hover:to-blue-800 transition transform hover:scale-105 shadow-lg hover:shadow-xl animate-fade-in-up">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                    Login sebagai Admin
                </a>
                
                <a href="{{ route('guest.login') }}" 
                   class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4 rounded-xl flex items-center justify-center font-medium hover:from-green-600 hover:to-emerald-700 transition transform hover:scale-105 shadow-lg hover:shadow-xl animate-fade-in-up-delayed">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    Masuk sebagai User
                </a>
            </div>
        </div>
    </div>
    
    <!-- Floating elements decorative background -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute left-1/4 top-1/4 w-12 h-12 bg-blue-400 rounded-full opacity-20 animate-float-slow"></div>
        <div class="absolute right-1/3 top-1/2 w-8 h-8 bg-purple-400 rounded-full opacity-20 animate-float-medium"></div>
        <div class="absolute left-1/2 bottom-1/4 w-10 h-10 bg-green-400 rounded-full opacity-20 animate-float-fast"></div>
        <div class="absolute right-1/4 bottom-1/3 w-6 h-6 bg-yellow-400 rounded-full opacity-20 animate-float-slow"></div>
    </div>
</div>

@endsection
