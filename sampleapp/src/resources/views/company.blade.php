@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-16">
    <div class="max-w-6xl mx-auto px-6">
        <!-- Hero Section -->
        <div class="text-center mt-10">
            <h1 class="text-4xl font-extrabold text-gray-900">Tentang <span class="text-indigo-600">InfraReport</span></h1>
            <p class="mt-4 text-lg text-gray-600">Sistem Pengaduan Infrastruktur yang Cepat, Transparan, dan Efektif</p>
        </div>

        <!-- Visi & Misi -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-indigo-600">Visi</h3>
                <p class="mt-2 text-gray-700">
                    Menjadi platform terpercaya dalam memfasilitasi pengaduan infrastruktur, 
                    memastikan setiap laporan ditindaklanjuti dengan transparansi dan akurasi.
                </p>
            </div>
            <div class="p-6 bg-white rounded-lg shadow-md">
                <h3 class="text-2xl font-semibold text-indigo-600">Misi</h3>
                <ul class="mt-2 text-gray-700 list-disc pl-5 space-y-2">
                    <li>Mempermudah pelaporan infrastruktur oleh masyarakat.</li>
                    <li>Menjalin kerja sama dengan instansi terkait untuk tindak lanjut cepat.</li>
                    <li>Menyediakan informasi status pengaduan secara real-time.</li>
                </ul>
            </div>
        </div>

        <!-- Layanan Kami -->
        <div class="mt-16 text-center">
            <h2 class="text-3xl font-bold text-gray-900">Layanan Kami</h2>
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <span class="text-3xl">📌</span>
                    <h4 class="text-xl font-semibold text-indigo-600 mt-2">Pelaporan Infrastruktur</h4>
                    <p class="text-gray-600 mt-2">Laporkan masalah infrastruktur dengan mudah dan cepat melalui platform kami.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <span class="text-3xl">📊</span>
                    <h4 class="text-xl font-semibold text-indigo-600 mt-2">Monitoring Laporan</h4>
                    <p class="text-gray-600 mt-2">Pantau status pengaduan secara real-time untuk mengetahui perkembangannya.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                    <span class="text-3xl">🤝</span>
                    <h4 class="text-xl font-semibold text-indigo-600 mt-2">Kolaborasi Instansi</h4>
                    <p class="text-gray-600 mt-2">Kami bekerja sama dengan instansi pemerintah untuk menyelesaikan laporan Anda.</p>
                </div>
            </div>
        </div>

        <!-- Kontak -->
        <div class="mt-16 bg-indigo-600 text-white py-10 px-6 rounded-lg shadow-md">
            <h3 class="text-2xl font-semibold">Hubungi Kami</h3>
            <p class="mt-2">Jika Anda memiliki pertanyaan, silakan hubungi kami melalui email atau telepon.</p>
            <div class="mt-4">
                <p class="text-lg">📧 Email: <a href="mailto:support@infrareport.com" class="underline">support@infrareport.com</a></p>
                <p class="text-lg">📞 Telepon: +62 812 3456 7890</p>
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