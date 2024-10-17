<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Profile</title>
    @vite('resources/css/app.css') 
</head>
<body class="flex justify-center items-center min-h-screen bg-gradient-to-r from-purple-400 via-pink-500 to-red-500">
    <div class="text-center bg-white p-12 rounded-[30px] shadow-2xl transform transition duration-500 hover:scale-105 hover:shadow-2xl w-full max-w-3xl">
        <!-- Logo Profile -->
        @php
            $defaultFoto = 'path/to/default-foto.jpg'; // Pastikan path ke foto default benar
            $userFoto = $user->foto ? asset('upload/img/' . $user->foto) : asset($defaultFoto);
        @endphp

        <img src="{{ $user->foto ? asset('upload/img/' . $user->foto) : asset('path/to/default-foto.jpg') }}" alt="Profile Logo" class="mx-auto mb-8 rounded-full w-40 h-40 object-cover ring-4 ring-purple-500 shadow-lg">


        <!-- Tabel Data -->
        <div class="space-y-6">
            <div class="flex items-center justify-center bg-gradient-to-r from-purple-400 to-purple-600 p-5 rounded-lg shadow-md hover:from-purple-500 hover:to-purple-700 transition duration-300 hover:scale-110">
                <span class="text-white text-xl font-semibold">{{ $user->nama }}</span>
            </div>

            <div class="flex items-center justify-center bg-gradient-to-r from-green-400 to-green-600 p-5 rounded-lg shadow-md hover:from-green-500 hover:to-green-700 transition duration-300 hover:scale-110">
                <span class="text-white text-xl font-semibold">{{ $user->npm }}</span>
            </div>

            <div class="flex items-center justify-center bg-gradient-to-r from-blue-400 to-blue-600 p-5 rounded-lg shadow-md hover:from-blue-500 hover:to-blue-700 transition duration-300 hover:scale-110">
                <span class="text-white text-xl font-semibold">{{ $user->kelas->nama_kelas ?? 'Kelas tidak ditemukan' }}</span>
            </div>
        </div>

        <div class="mt-8">
            <button class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white text-lg font-bold rounded-full shadow-lg hover:from-purple-700 hover:to-pink-600 transition duration-300 transform hover:scale-110">
                Get Started
            </button>
        </div>
    </div>
</body>
</html>
