@extends('layouts.app')
@section('content')
@vite('resources/css/app.css') <!-- Tailwind CSS -->

<div class="bg-gradient-to-r from-blue-500 to-blue-300 min-h-screen flex items-center justify-center">
    <div class="bg-white p-10 rounded-lg shadow-2xl w-full max-w-lg">
        <h2 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-blue-300 text-center mb-10">
            Input Data Mahasiswa
        </h2>
        <form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="nama" class="block text-gray-700 text-lg font-semibold mb-2">Nama:</label>
                <input type="text" id="nama" name="nama" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @foreach ($errors->get('nama') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <div class="mb-6">
                <label for="npm" class="block text-gray-700 text-lg font-semibold mb-2">NPM:</label>
                <input type="text" id="npm" name="npm" 
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @foreach ($errors->get('npm') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <div class="mb-6">
                <label for="kelas_id" class="block text-gray-700 text-lg font-semibold mb-2">Kelas:</label>
                <select name="kelas_id" id="kelas_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                    @foreach($kelas as $kelasItem)
                        <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Menambahkan Dropdown untuk Jurusan -->
            <div class="mb-6">
                <label for="jurusan_id" class="block text-gray-700 text-lg font-semibold mb-2">Jurusan:</label>
                <select name="jurusan_id" id="jurusan_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                    @foreach($jurusan as $jurusanItem)
                        <option value="{{ $jurusanItem->id }}">{{ $jurusanItem->nama_jurusan }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Input file untuk foto -->
            <div class="mb-6">
                <label for="foto" class="block text-gray-700 text-lg font-semibold mb-2">Foto:</label>
                <input type="file" id="foto" name="foto" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:border-transparent transition duration-300 ease-in-out">
                @foreach ($errors->get('foto') as $msg )
                    <p class="text-red-500">{{ $msg }}</p>
                @endforeach
            </div>
    
            <button type="submit"
                    class="w-full bg-gradient-to-r from-blue-500 to-blue-300 text-white font-bold py-3 rounded-lg shadow-lg hover:shadow-2xl hover:from-blue-600 hover:to-blue-400 transform transition duration-500 ease-in-out">
                Submit
            </button>
        </form>
    </div>
</div>
@endsection
