@extends('layout.app')

@section('content')
    <style>
        .animate-lompat {
            animation: lompat 1s infinite alternate;
        }
        @keyframes lompat {
            0%   { transform: translateY(0); }
            100% { transform: translateY(-15px); }
        }

        .text-focus-in {
            animation: text-focus-in 1.5s ease-in-out forwards;
        }
        @keyframes text-focus-in {
            0% {
                filter: blur(12px);
                opacity: 0;
            }
            100% {
                filter: blur(0px);
                opacity: 1;
            }
        }
    </style>

    {{-- HEADER --}}
    <header id="header-panel" class="relative min-h-screen flex flex-col justify-center items-center font-['Jersey10'] px-4 pt-0">
        <div id="header" class="flex flex-col items-center text-center opacity-0">
            <img src="images/icon/ksmHytam.svg" alt="Logo KSM" class="w-60 mb-6">
            
            <h1 class="text-2xl sm:text-3xl tracking-wide">Kelompok Studi Mahasiswa Informatika</h1>
            <h2 class="text-2xl sm:text-3xl mb-2">UNIVERSITAS SURABAYA</h2>
            <h2 class="text-5xl sm:text-7xl font-bold tracking-widest uppercase">"We Not Me"</h2>

            <div class="flex gap-6 text-2xl sm:text-3xl mt-12">
                <a class="bg-black text-white py-3 px-8 rounded-2xl hover:bg-gray-800 transition-colors" href="">Join Us</a>
                <a class="border-2 border-black backdrop-blur-sm py-3 px-8 rounded-2xl hover:bg-black hover:text-white transition-colors" href="#navbar">About Us</a>
            </div>
        </div>

        <div class="absolute bottom-10 flex flex-col items-center text-2xl animate-lompat">
            <p class="mb-2">Scroll This Page</p>
            <img class="w-8" src="images/icon/arrow.svg" alt="arrow down">
        </div>
    </header>

    {{-- NAVBAR --}}
    @include ('layout.mainNavbar')

    {{-- MAIN CONTAINER --}}
    <main class="font-['Jersey10'] text-center">
        
        {{-- About Us --}}
        <section id="aboutus" class="max-w-4xl mx-auto py-20 px-6 opacity-0 translate-y-10 transition-all duration-1500 ease-out">
            <h2 class="text-5xl md:text-6xl mb-6">ABOUT US</h2>
            <p class="text-2xl md:text-3xl leading-relaxed">
                An Informatics Engineering student organization, established on the University of Surabaya Campus since 1998. We are located at the TF 4.10 Building, University of Surabaya Tenggilis.
            </p>
        </section>

        {{-- Our Vision --}}
        <section id="our-vision" class="max-w-4xl mx-auto py-20 px-6 opacity-0 translate-y-10 transition-all duration-1500 ease-out">
            <h2 class="text-5xl md:text-6xl mb-6">Our Vision</h2>
            <p class="text-2xl md:text-3xl leading-relaxed">
                To be an organization capable of accommodating, expanding knowledge, and realizing the aspirations of engineering faculty students related to Computer Science.
            </p>
        </section>

        {{-- DEPARTMENT --}}
        <section id="department" class="max-w-6xl mx-auto py-20 px-6 flex flex-col items-center">
            <h2 class="text-5xl md:text-6xl mb-12">DEPARTMENT</h2>

            {{-- Button --}}
            <form action="/our-team" method="GET" class="relative mb-16 inline-block group">
                <button type="submit" class="text-2xl bg-black text-white py-3 px-8 rounded-full hover:scale-105 transition-transform duration-300">
                    Let's see our team
                </button>
                {{-- Posisi absolute diikat ke form parent, aman dari resize layar --}}
                <img src="/images/icon/click_this.webp" alt="Click this pointer" class="absolute -right-16 top-4 w-16 pointer-events-none group-hover:animate-pulse">
            </form>

            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-12 text-center">
                
                {{-- BPH --}}
                <div id="department-BPH" class="md:col-span-2 flex flex-col items-center hover:-translate-y-1 transition-transform duration-300 ">
                    <h3 class="text-5xl font-bold">BPH</h3>
                    <h4 class="text-3xl mb-4">(Badan Pengurus Harian)</h4>
                    <p class="text-2xl md:text-3xl max-w-2xl leading-snug">
                        The foundation of the organization that keeps everything aligned—streamlining the flow, sustaining the rhythm, and guiding every step forward with purpose and momentum.
                    </p>
                    <p class="text-2xl md:text-3xl mt-6 italic">One movement, driven by four essential roles:</p>
                    <p class="text-3xl md:text-4xl mt-2 font-semibold tracking-wide">Ketua • Wakil-Ketua • Sekretaris • Bendahara</p>
                </div>

                {{-- IRD --}}
                <div id="department-IRD" class="flex flex-col items-center px-4 hover:-translate-y-1 transition-transform duration-300">
                    <h3 class="text-4xl md:text-5xl font-bold">IRD</h3>
                    <h4 class="text-2xl md:text-3xl mb-4">(Internal Relation Department)</h4>
                    <p class="text-2xl md:text-3xl leading-snug">
                        The team that holds KSM IF together. Making room for new friendships, real support, and growth every step of the way.
                    </p>
                </div>

                {{-- PRD --}}
                <div id="department-PRD" class="flex flex-col items-center px-4 hover:-translate-y-1 transition-transform duration-300">
                    <h3 class="text-4xl md:text-5xl font-bold">PRD</h3>
                    <h4 class="text-2xl md:text-3xl mb-4">(Public Relation Department)</h4>
                    <p class="text-2xl md:text-3xl leading-snug">
                        Behind every handshake between KSM IF and the outside world. The team who translate ideas into clear communication, contacts into partnerships, and keep KSM IF’s image shining bright.
                    </p>
                </div>

                {{-- HRDD --}}
                <div id="department-HRDD" class="flex flex-col items-center px-4 hover:-translate-y-1 transition-transform duration-300">
                    <h3 class="text-4xl md:text-5xl font-bold">HRDD</h3>
                    <h4 class="text-2xl md:text-3xl mb-4">(Human Resource Development Department)</h4>
                    <p class="text-2xl md:text-3xl leading-snug">
                        An organization runs on its people. Human Resource Development Department job is to help every member update, grow, and unlock their best version.
                    </p>
                </div>

                {{-- CDD --}}
                <div id="department-CDD" class="flex flex-col items-center px-4 hover:-translate-y-1 transition-transform duration-300">
                    <h3 class="text-4xl md:text-5xl font-bold">CDD</h3>
                    <h4 class="text-2xl md:text-3xl mb-4">(Creative Design Department)</h4>
                    <p class="text-2xl md:text-3xl leading-snug">
                        Every great moment tells a story. The Creative Design Department captures it, preserves it, and turns KSM-IF's warmest moments into memories that last.
                    </p>
                </div>

            </div>
        </section>
    </main>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        setTimeout(() => {
            const header = document.getElementById('header');
            if(header) header.classList.add('text-focus-in');
        }, 1500);

        const scrollObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.remove("opacity-0", "translate-y-10");
                    entry.target.classList.add("opacity-100", "translate-y-0");
                } else {
                    entry.target.classList.remove("opacity-100", "translate-y-0");
                    entry.target.classList.add("opacity-0", "translate-y-10");
                }
            });
        }, { 
            threshold: 0.2, // Trigger saat 20% elemen masuk layar
            rootMargin: "0px 0px -50px 0px"
        });

        
        scrollObserver.observe($('#aboutus')[0]);
        scrollObserver.observe($('#our-vision')[0]);
    });
</script>
@endsection