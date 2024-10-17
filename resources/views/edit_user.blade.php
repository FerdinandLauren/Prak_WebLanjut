<!-- resources/views/form.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Mahasiswa</title>
    @vite('resources/css/app.css') <!-- Tailwind CSS -->
</head>
@extends('layouts.app')
@section('content')
<div class="bg-blue-500 min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-lg shadow-2xl w-full max-w-lg transition duration-500">
        <h2 class="text-4xl font-extrabold text-center text-blue-700 mb-10">
            Edit Data Mahasiswa
        </h2>
        <form action="{{ route('user.update', $user['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 text-lg font-semibold mb-2">Nama:</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama',$user->nama) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @foreach ($errors->get('nama') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <div class="mb-6">
                <label for="npm" class="block text-gray-700 text-lg font-semibold mb-2">NPM:</label>
                <input type="text" id="npm" name="npm" value="{{ old('npm',$user->npm) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @foreach ($errors->get('npm') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <div class="mb-6">
                <label for="kelas_id" class="block text-gray-700 text-lg font-semibold mb-2">Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out" required>
                    @foreach($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}"
                            {{ $kelasItem->id == $user->kelas_id ? 'selected' : '' }}>
                            {{ $kelasItem->nama_kelas }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Input file untuk foto -->
            <div class="mb-6">
                <label for="foto" class="block text-gray-700 text-lg font-semibold mb-2">Foto:</label>
                <input type="file" id="foto" name="foto" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @if ($user->foto)
                <img src="{{ asset('upload/img/' . $user->foto) }}" alt="User Photo" class="w-32 h-32 mt-3 object-cover rounded-lg">
                @endif
                @foreach ($errors->get('foto') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-700 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-2xl hover:from-blue-600 hover:to-blue-800 transform hover:-translate-y-1 transition duration-500 ease-in-out">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
