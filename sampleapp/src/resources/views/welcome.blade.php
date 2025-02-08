@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<!-- Hero Section -->
<div class="bg-white">
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="mx-auto max-w-6xl py-32 sm:py-48 lg:py-56">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <!-- Text Section -->
                <div class="text-left lg:w-1/2">
                    <h1 class="text-5xl font-semibold tracking-tight text-gray-900 sm:text-7xl">Pengaduan Masyarakat</h1>
                    <p class="mt-8 text-lg font-medium text-gray-500 sm:text-xl/8">Sistem untuk mempermudah pelaporan dan penyelesaian pengaduan masyarakat.</p>
                    <div class="mt-10 flex items-center gap-x-6">
                        <a href="{{ url('/masyarakat/login') }}" class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get started</a>
                        <a href="/features" class="text-sm font-semibold text-gray-900">Learn more <span aria-hidden="true">→</span></a>
                    </div>
                </div>
                <!-- Image Section -->
                <div class="lg:w-1/2 flex justify-center lg:justify-end mt-10 lg:mt-0">
                    <img id="heroImg1" class="transition-all duration-300 ease-in-out hover:scale-105 w-full max-w-lg sm:mx-auto" src="https://bootstrapmade.com/demo/templates/FlexStart/assets/img/hero-img.png" alt="Awesome hero page image" width="500" height="488"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Timeline Section -->
<div class="max-w-6xl mx-auto px-6 py-12 -mt-20">
    <h2 class="text-3xl font-bold text-center text-gray-900">Proses Pengaduan</h2>
    <div class="flex flex-row gap-6 mt-8 overflow-x-auto">
        <!-- Step 1: Register & Login -->
        <div class="bg-blue-50 shadow-lg rounded-xl p-6 text-center min-w-[250px] flex-1">
            <span class="bg-blue-600 p-3 rounded-full inline-block text-white text-2xl">👤</span>
            <time class="block font-mono italic mt-2 text-blue-700">Langkah 1</time>
            <div class="text-lg font-semibold text-blue-900">Registrasi & Login</div>
            <p class="text-gray-700">Pengguna mendaftar dan masuk ke sistem untuk mengakses layanan pengaduan.</p>
        </div>
        <!-- Step 2: Membuat Pengaduan -->
        <div class="bg-blue-50 shadow-lg rounded-xl p-6 text-center min-w-[250px] flex-1">
            <span class="bg-blue-600 p-3 rounded-full inline-block text-white text-2xl">📝</span>
            <time class="block font-mono italic mt-2 text-blue-700">Langkah 2</time>
            <div class="text-lg font-semibold text-blue-900">Mengajukan Pengaduan</div>
            <p class="text-gray-700">Pengguna mengisi formulir dengan detail pengaduan terkait infrastruktur.</p>
        </div>
        <!-- Step 3: Verifikasi oleh Petugas -->
        <div class="bg-blue-50 shadow-lg rounded-xl p-6 text-center min-w-[250px] flex-1">
            <span class="bg-blue-600 p-3 rounded-full inline-block text-white text-2xl">🔍</span>
            <time class="block font-mono italic mt-2 text-blue-700">Langkah 3</time>
            <div class="text-lg font-semibold text-blue-900">Verifikasi</div>
            <p class="text-gray-700">Petugas mengecek kelayakan pengaduan untuk diteruskan ke instansi terkait.</p>
        </div>
        <!-- Step 4: Pengaduan Diteruskan -->
        <div class="bg-blue-50 shadow-lg rounded-xl p-6 text-center min-w-[250px] flex-1">
            <span class="bg-blue-600 p-3 rounded-full inline-block text-white text-2xl">📨</span>
            <time class="block font-mono italic mt-2 text-blue-700">Langkah 4</time>
            <div class="text-lg font-semibold text-blue-900">Diteruskan ke Instansi</div>
            <p class="text-gray-700">Pengaduan yang valid akan dikirim ke instansi terkait untuk diproses lebih lanjut.</p>
        </div>
    </div>
</div>

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
