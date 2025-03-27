@extends('layouts.app')
<head>
    <link rel="stylesheet" href="{{ asset('css/filament/style.css') }}">
</head>


@section('content')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100">
    <!-- Logo Sekolah -->
    <img src="{{ asset('storage/image/download.jpeg') }}" alt="Logo Sekolah" class="w-35 h-35 mb-4 animate-fade-in">

    <!-- Judul -->
    <h1 class="text-3xl font-bold mb-6 animate-fade-in">Selamat Datang di Metschoo-Canteen</h1>

    <!-- Kotak Pilihan Login -->
    <div class="flex flex-col space-y-4 w-64">
        <a href="{{ route('filament.admin.auth.login') }}" 
           class="bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-700 transition transform hover:scale-105 animate-fade-in delay-100">
            Login sebagai Admin
        </a>

        <a href="{{ route('guest.login') }}" 
           class="bg-green-500 text-white px-6 py-3 rounded-md hover:bg-green-700 transition transform hover:scale-105 animate-fade-in delay-200">
            Masuk sebagai User
        </a>
    </div>
</div>
@endsection
