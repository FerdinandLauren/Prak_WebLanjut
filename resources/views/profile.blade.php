<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Profile</title>
    @vite('resources/css/app.css')
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-r from-orange-500 via-black-500 to-blue-500">
    <div class="bg-white shadow-md rounded-lg p-6 flex flex-col items-center">
        <!-- Container untuk Foto Profil -->
        <div class="mb-4">
            <img src="{{ asset('/Profil.jpg') }}" alt="Foto Profil" class="w-24 h-24 rounded-full object-cover">
        </div>

        <!-- Table untuk Nama, Kelas, dan NPM -->
        <table class="table-auto">
            <tr class="border-b">
                <td class="px-4 py-2 font-semibold">Nama</td>
                <td class="px-4 py-2">:</td>
                <td class="px-4 py-2"><?= $nama ?></td>
            </tr>
            <tr class="border-b">
                <td class="px-4 py-2 font-semibold">Kelas</td>
                <td class="px-4 py-2">:</td>
                <td class="px-4 py-2"><?= $kelas ?></td>
            </tr>
            <tr class="border-b">
                <td class="px-4 py-2 font-semibold">NPM</td>
                <td class="px-4 py-2">:</td>
                <td class="px-4 py-2"><?= $npm ?></td>
            </tr>
        </table>
    </div>
</body>
</html>