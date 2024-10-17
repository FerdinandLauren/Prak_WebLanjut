@extends('layouts.app')
@section ('content')
@vite('resources/css/app.css') <!-- Tailwind CSS -->
<div class="flex justify-center items-center min-h-screen bg-white-500">
    <div class="text-center bg-white p-12 rounded-[30px] shadow-2xl w-full max-w-3xl">
        <!-- Logo Profile -->
        @php
            $defaultFoto = 'path/to/default-foto.jpg'; // Pastikan path ke foto default benar
            $userFoto = $user->foto ? asset('upload/img/' . $user->foto) : asset($defaultFoto);
        @endphp

        <img src="{{ $userFoto }}" alt="Profile Logo" class="mx-auto mb-8 rounded-full w-40 h-40 object-cover ring-4 ring-blue-500 shadow-lg">

        <!-- Tabel Data -->
        <div class="space-y-6">
            <div class="flex items-center justify-center bg-blue-500 p-5 rounded-lg shadow-md">
                <span class="text-white text-xl font-semibold">{{ $user->nama }}</span>
            </div>

            <div class="flex items-center justify-center bg-blue-500 p-5 rounded-lg shadow-md">
                <span class="text-white text-xl font-semibold">{{ $user->npm }}</span>
            </div>

            <div class="flex items-center justify-center bg-blue-500 p-5 rounded-lg shadow-md">
                <span class="text-white text-xl font-semibold">{{ $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
            </div>
        </div>

        <div class="mt-8">
            <a href="{{ route('user.list') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Kembali ke Daftar
            </a>
        </div>
    </div>
</div>
@endsection
