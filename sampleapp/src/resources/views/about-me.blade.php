@extends('layouts.app')

@section('content')

<section class="bg-gray-100 min-h-screen flex items-center justify-center px-6">
    <div class="w-full max-w-6xl bg-white shadow-lg rounded-lg overflow-hidden p-10 md:p-16 flex flex-col md:flex-row items-center gap-10">
        <!-- Image Section -->
        <div class="w-48 h-48 md:w-64 md:h-64 flex-shrink-0">
            <img
                class="w-full h-full object-cover rounded-full shadow-md transform hover:scale-110 transition-transform duration-500"
                src="{{ asset('storage/p.jpg') }}"
                alt="Profile Image"
            />
        </div>

        <!-- Text Section -->
        <div class="flex-1 text-center md:text-left">
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">
                Kepada Yth. <span class="text-indigo-600">Anraaa</span>
            </h1>
            <p class="text-gray-700 text-lg mb-6 leading-relaxed">
                Ini deskripsinya diisi apaan njir
            </p>

            <!-- Social Links Section -->
            <div class="flex justify-center md:justify-start gap-4">
                <a
                    rel="noopener"
                    target="_blank"
                    href="#"
                    class="flex items-center bg-gray-900 hover:bg-gray-700 text-white rounded-lg px-5 py-3 transition duration-300 ease-in-out transform hover:scale-105"
                >
                    <img class="w-6 h-6 mr-2" src="https://ucarecdn.com/1f465c47-4849-4935-91f4-29135d8607af/github2.svg" alt="Github" />
                    <span>Github</span>
                </a>

                <a
                    rel="noopener"
                    target="_blank"
                    href="#"
                    class="flex items-center bg-pink-500 hover:bg-pink-600 text-white rounded-lg px-5 py-3 transition duration-300 ease-in-out transform hover:scale-105"
                >
                    <img class="w-6 h-6 mr-2" src="https://upload.wikimedia.org/wikipedia/commons/9/95/Instagram_logo_2022.svg" alt="Instagram" />
                    <span>Instagram</span>
                </a>
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
