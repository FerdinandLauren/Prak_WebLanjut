@extends('layouts.app')
@section ('content')
@vite('resources/css/app.css') <!-- Tailwind CSS -->

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center bg-gradient-to-r from-blue-500 to-blue-600 bg-clip-text text-transparent">
        Daftar Pengguna
    </h1>
    
    <a href="{{ route('user.create') }}" class="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-3 transition duration-300">
        Tambah Pengguna Baru
    </a>    
    
    <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
        <table class="min-w-full border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-blue-500 to-blue-600 text-white">
                <tr>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Nama</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">NPM</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Kelas</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Foto</th>
                    <th class="px-6 py-3 text-center text-sm font-medium uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>            
            <tbody>
                @foreach ($users as $user)
                    <tr class=" hover:bg-gray-200 transition-colors">
                        <td class="px-6 py-4 border-b border-gray-200 text-center">{{ $user['id'] }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">{{ $user['nama'] }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">{{ $user['npm'] }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">{{ $user['nama_kelas'] }}</td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">
                            @if($user->foto)
                                <img src="{{ asset('upload/img/' . $user->foto) }}" alt="Foto {{ $user->nama }}" class="w-20 h-20 object-cover rounded">
                            @else
                                <span>Tidak ada foto</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 border-b border-gray-200 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</button>
                            <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            <a href="{{ route('user.show', $user->id) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-300">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
