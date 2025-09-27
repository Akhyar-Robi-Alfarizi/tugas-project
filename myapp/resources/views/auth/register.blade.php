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
    {{-- Kolom kiri --}}
    <div class="w-1/2 h-screen bg-[#D2E7F9]">
      <div class="flex h-full flex-col justify-center items-center px-6">
        <img src="https://png.pngtree.com/png-clipart/20221227/original/pngtree-host-and-admin-marketing-job-vacancies-vector-png-image_8815346.png" alt="" class="size-9/12 object-contain" />
        <div class="mt-4 text-5xl font-bold text-black">Hello Bendahara</div>
      </div>
    </div>

    {{-- Kolom kanan --}}
    <div class="w-1/2 h-screen flex justify-center items-center">
      <div class="w-3/4 max-w-md">
        <div class="text-3xl font-bold mb-2">Register</div>
        <div class="mb-4 block font-medium text-gray-700">Silahkan isi data di bawah ini dengan benar</div>

        {{-- Error global (opsional) --}}
        @if ($errors->any())
        <div class="mb-4 rounded-md bg-red-50 px-4 py-3 text-sm text-red-700">
          <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" class="flex flex-col space-y-4">
          @csrf

          <!-- Nama: GANTI name="name" menjadi name="nama" -->
          <div>
            <label for="nama" class="block font-medium text-gray-700">Nama Lengkap</label>
            <input id="nama" name="nama" type="text" value="{{ old('nama') }}"
              class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 @error('nama') border-red-400 @else border-gray-300 @enderror"
              placeholder="Mis. Akhyar Robi" required>
            @error('nama') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="email" class="block font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" value="{{ old('email') }}"
              class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 @error('email') border-red-400 @else border-gray-300 @enderror"
              placeholder="nama@email.com">
            @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password" class="block font-medium text-gray-700">Password</label>
            <input id="password" name="password" type="password" minlength="8" autocomplete="new-password"
              class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300 @error('password') border-red-400 @else border-gray-300 @enderror"
              placeholder="Minimal 8 karakter" required>
            @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
          </div>

          <div>
            <label for="password_confirmation" class="block font-medium text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" minlength="8" autocomplete="new-password"
              class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-300"
              required>
          </div>

          <button class="bg-[#4B78AF] text-white font-semibold py-2 px-4 rounded hover:bg-[#4a6484]">
            Daftar
          </button>

          <p class="text-sm text-gray-600">
            Sudah punya akun? <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Masuk di sini</a>
          </p>
        </form>

      </div>
    </div>
  </div>
</body>

</html>