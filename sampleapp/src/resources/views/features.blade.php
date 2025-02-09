@extends('layouts.app')

@section('content')

<section class="min-h-screen flex items-center justify-center">
  <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="max-w-xl mb-10 sm:mx-auto">
      <h2 class="font-sans text-3xl font-bold leading-tight tracking-tight text-gray-900 sm:text-4xl sm:text-center">
        Sistem Pengaduan Masyarakat
        <span class="inline-block text-deep-purple-accent-400">Cepat. Transparan. Responsif.</span>
      </h2>
    </div>
    <div class="grid gap-12 row-gap-8 lg:grid-cols-3">
      <!-- Registrasi & Login -->
      <div class="flex">
        <div class="mr-4">
          <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-indigo-50">
          <svg class="w-8 h-8 text-blue-500" stroke="currentColor" viewBox="0 0 52 52">
              <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
            </svg>
          </div>
        </div>
        <div>
          <h6 class="mb-2 font-semibold leading-5">Registrasi & Login</h6>
          <p class="text-sm text-gray-900">
            Pengguna harus mendaftar dan masuk untuk dapat mengajukan pengaduan terkait infrastruktur.
          </p>
        </div>
      </div>
      <!-- Buat Pengaduan -->
      <div class="flex">
        <div class="mr-4">
          <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-indigo-50">
            <svg class="w-8 h-8 text-blue-500" stroke="currentColor" viewBox="0 0 52 52">
              <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
            </svg>
          </div>
        </div>
        <div>
          <h6 class="mb-2 font-semibold leading-5">Buat Pengaduan</h6>
          <p class="text-sm text-gray-900">
            Pengguna dapat membuat pengaduan yang hanya mencakup masalah infrastruktur.
          </p>
        </div>
      </div>
      <!-- Verifikasi & Status Pengaduan -->
      <div class="flex">
        <div class="mr-4">
          <div class="flex items-center justify-center w-10 h-10 mb-3 rounded-full bg-indigo-50">
            <svg class="w-8 h-8 text-indigo-600" stroke="currentColor" viewBox="0 0 52 52">
              <polygon stroke-width="3" stroke-linecap="round" stroke-linejoin="round" fill="none" points="29 13 14 29 25 29 23 39 38 23 27 23"></polygon>
            </svg>
          </div>
        </div>
        <div>
          <h6 class="mb-2 font-semibold leading-5">Verifikasi & Status Pengaduan</h6>
          <p class="text-sm text-gray-900">
            Petugas akan memverifikasi pengaduan sebelum meneruskannya ke instansi terkait. Pengguna dapat melacak status pengaduan hingga diteruskan.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer Section -->
<footer class="bg-gradient-to-b from-indigo-900 to-black text-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-center">
            <!-- About -->
            <div>
                <h3 class="text-2xl font-bold tracking-wide">InfraReport™</h3>
                <p class="mt-2 text-gray-400">
                    Platform pelaporan yang cepat, aman, dan transparan. Didukung oleh teknologi terbaik untuk kenyamanan Anda.
                </p>
            </div>

            <!-- Quick Links -->
            <div class="text-center">
                <h3 class="text-lg font-semibold uppercase">Navigasi</h3>
                <ul class="mt-3 space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition-all duration-300">Home</a></li>
                    <li><a href="/features" class="text-gray-400 hover:text-white transition-all duration-300">Features</a></li>
                    <li><a href="/company" class="text-gray-400 hover:text-white transition-all duration-300">Company</a></li>
                    <li><a href="/about-me" class="text-gray-400 hover:text-white transition-all duration-300">About Me</a></li>
                </ul>
            </div>

            <!-- Social Links -->
            <div class="text-center md:text-right">
                <h3 class="text-lg font-semibold uppercase">Ikuti Kami</h3>
                <div class="flex justify-center md:justify-end mt-4 space-x-4">
                    <a href="#" class="text-gray-400 hover:text-pink-500 transition-transform duration-300 transform hover:scale-110">
                        <i class="fab fa-instagram text-2xl"></i>
                        <img class="w-6 h-6 mr-2" src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram" />
                    </a>
                    <a href="#" class="text-gray-400 hover:text-gray-300 transition-transform duration-300 transform hover:scale-110">
                        <i class="fab fa-github text-2xl"></i>
                        <img class="w-6 h-6 mr-2" src="https://ucarecdn.com/1f465c47-4849-4935-91f4-29135d8607af/github2.svg" alt="Github" />
                    </a>
                </div>
            </div>


        <hr class="border-gray-700 my-8">

        <!-- Copyright -->
        <div class="text-center text-gray-400 text-sm">
            <p>© 2025 InfraReport™. All Rights Reserved.</p>
            <p class="mt-2">
                Built with <a href="https://filamentphp.com/" class="text-purple-400 hover:text-white transition duration-300">Filament</a> and 
                <a href="https://tailwindcss.com" class="text-purple-400 hover:text-white transition duration-300">Tailwind CSS</a>.
            </p>
        </div>
    </div>
</footer>

<!-- FontAwesome for icons -->
<script src="https://kit.fontawesome.com/YOUR-FONTAWESOME-KIT.js" crossorigin="anonymous"></script>


@endsection