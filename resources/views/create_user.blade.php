<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

    <div class="container mx-auto my-10 p-5 max-w-lg">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-4">Form Input Data Mahasiswa</h1>

            <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="nama" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" id="nama" name="nama" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <div>
                    <label for="npm" class="block text-gray-700 text-sm font-bold mb-2">NPM:</label>
                    <input type="text" id="npm" name="npm" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <div>
                    <label for="kelas" class="block text-gray-700 text-sm font-bold mb-2">Kelas:</label>
                    <input type="text" id="kelas" name="kelas" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:border-blue-500" required>
                </div>

                <div class="text-center">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>