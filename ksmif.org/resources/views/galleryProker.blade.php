@extends('layout.app')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20 font-['Jersey10']">
        <header class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-6xl md:text-5xltext-gray-900 mb-4">
                Gallery Proker
            </h1>
            <p class="text-lg text-gray-600 mb-8">
                Welcome to our track record. Browse through our past events and explore the work programs we're building together.
            </p>
        </header>

        <!-- Grid Gallery Proker -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Kartu Proker 1 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm border-2 border-gray-800 border-dashed card-hover flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="" referrerpolicy="no-referrer" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-200 text-red-800 text-2xs px-3 py-1 rounded-full uppercase tracking-wide">closed</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col grow">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="font-medium text-gray-600">TC 04.01*</span>
                        <span class="mx-2">•</span>
                        <time>11 April - 20 Juni 2026</time>
                    </div>
                    <h2 class="text-2xl text-gray-900 mb-2 leading-tight">StudyClub 2026</h2>
                    <p class="text-gray-600 mb-6 grow line-clamp-3">
                        Pelatihan dan diskusi interaktif selama 8 minggu untuk mengembangkan skill sebelum mengikuti lomba pada mahasiswa Informatika.
                    </p>
                    <a href="/tes" class="inline-flex items-center text-gray-600 font-semibold hover:text-blue-800 transition">
                        Lihat Dokumentasi 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>

            <!-- Kartu Proker 2 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm border-2 border-gray-800 border-dashed card-hover flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-200 text-red-800 text-2xs px-3 py-1 rounded-full uppercase tracking-wide">closed</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col grow">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="font-medium text-gray-600">PT. Bursa Efek Indonesia & PT. Amerta Indah Otsuka</span>
                        <span class="mx-2">•</span>
                        <time>21 Juli 2026</time>
                    </div>
                    <h2 class="text-xl  text-gray-900 mb-2 leading-tight">Studi Ekskursi 2026</h2>
                    <p class="text-gray-600 mb-6 grow line-clamp-3">
                        Studi Ekskursi merupakan kegiatan pembelajaran di luar kampus dengan mengunjungi perusahaan khususnya yang melibatkan bidang Informatika.
                    </p>
                    <a href="/tes" class="inline-flex items-center text-gray-600 font-semibold hover:text-blue-800 transition">
                        Lihat Dokumentasi 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>

            <!-- Kartu Proker 3 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm border-2 border-gray-800 border-dashed  card-hover flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-200 text-red-800 text-2xs px-3 py-1 rounded-full uppercase tracking-wide">closed</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col grow">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="font-medium text-gray-600">UBAYA Training Center</span>
                        <span class="mx-2">•</span>
                        <time>7 - 8 Maret 2026</time>
                    </div>
                    <h2 class="text-xl  text-gray-900 mb-2 leading-tight">Informatics Gathering</h2>
                    <p class="text-gray-600 mb-6 grow line-clamp-3">
                        Informatics Gathering merupakan kegiatan kebersamaan mahasiswa Teknik Informatika UBAYA yang dirancang sebagai ruang untuk saling mengenal, terhubung, dan membangun relasi lintas angkatan. Melalui kegiatan ini, kita diajak untuk berbagi cerita, pengalaman, dan menciptakan momen hangat yang bermakna bersama
                    </p>
                    <a href="/tes" class="inline-flex items-center text-gray-600 font-semibold hover:text-blue-800 transition">
                        Lihat Dokumentasi 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>

            <!-- Kartu Proker 4 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-sm border-2 border-gray-800 border-dashed card-hover flex flex-col">
                <div class="relative h-56 overflow-hidden">
                    <img src="" class="w-full h-full object-cover">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-200 text-red-800 text-2xs px-3 py-1 rounded-full uppercase tracking-wide">closed</span>
                    </div>
                </div>
                <div class="p-6 flex flex-col grow">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <span class="font-medium text-gray-600">UBAYA Training Center</span>
                        <span class="mx-2">•</span>
                        <time>7 - 8 Maret 2026</time>
                    </div>
                    <h2 class="text-xl  text-gray-900 mb-2 leading-tight">Informatics Gathering</h2>
                    <p class="text-gray-600 mb-6 grow line-clamp-3">
                        Informatics Gathering merupakan kegiatan kebersamaan mahasiswa Teknik Informatika UBAYA yang dirancang sebagai ruang untuk saling mengenal, terhubung, dan membangun relasi lintas angkatan. Melalui kegiatan ini, kita diajak untuk berbagi cerita, pengalaman, dan menciptakan momen hangat yang bermakna bersama
                    </p>
                    <a href="/tes" class="inline-flex items-center text-gray-600 font-semibold hover:text-blue-800 transition">
                        Lihat Dokumentasi 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                    </a>
                </div>
            </article>
        </div>

    </main>
@endsection