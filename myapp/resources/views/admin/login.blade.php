<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bendahara</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
     <!-- Styles / Scripts -->
     @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /*! tailwindcss v4.0.7 | MIT License | https://tailwindcss.com */
            </style>
        @endif
</head>
<body>
    <div class="flex">
        <div class="w-1/2 h-screen bg-[#D2E7F9]">
            <div class="flex flex-col justify-center items-center">
                <img src="https://png.pngtree.com/png-clipart/20221227/original/pngtree-host-and-admin-marketing-job-vacancies-vector-png-image_8815346.png" alt="" class='size-9/12' />
                <div class="text-5xl font-bold text-black">Hello Bendahara</div>
            </div>
        </div>
        <div class="w-1/2 h-screen flex justify-center items-center">
            <div class="w-3/4 max-w-md">
                <div class="text-3xl font-bold mb-2">Login</div>
                <div class="mb-4 block font-medium text-gray-700">Silahkan Isi Email dan Password dengan benar</div>
                <form action="" class="flex flex-col space-y-4">
                    <div class="">
                        <label for="email" class="block font-medium text-gray-700">Email</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                    </div>
                    <div class="">
                        <label for="password" class="block font-medium text-gray-700">Password</label>
                        <input type="text" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300">
                    </div>
                    <button class="bg-[#4B78AF] text-white font-semibold py-2 px-4 rounded hover:bg-[#4a6484]">
                        Masuk
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>