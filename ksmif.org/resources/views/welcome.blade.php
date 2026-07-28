@extends('layout.app')

@section('content')
    <style>
        #arrow-scroll{
            animation: lompat 1s infinite alternate;
        }
        @keyframes lompat{
            0%      {transform: translateY(0);}
            100%    {transform: translateY(-30px);}
        }

        .text-focus-in {
        -webkit-animation: text-focus-in 1.5s ease-in-out ;
                animation: text-focus-in 1.5s ease-in-out ;
        }

    @-webkit-keyframes text-focus-in {
        0% {
            -webkit-filter: blur(12px);
                    filter: blur(12px);
            opacity: 0;
        }
        100% {
            -webkit-filter: blur(0px);
                    filter: blur(0px);
            opacity: 1;
        }
    }

    @keyframes text-focus-in {
        0% {
            -webkit-filter: blur(12px);
                    filter: blur(12px);
            opacity: 0;
        }
        100% {
            -webkit-filter: blur(0px);
                    filter: blur(0px);
            opacity: 1;
        }
    }
    </style>

    {{-- HEADER --}}
    <div id="header-panel" class="h-screen justify-center-safe place-items-center grid sm:mt-[5%] font-['Jersey10'] mt-[20%]">
        <div id="header" class="grid justify-center place-items-center">
            <iframe src="images/icon/ksmHytam.svg" type="image/svg+xml"></iframe>
            <h1 class="sm:text-3xl sm:mt-3 text-2xl">Kelompok Studi Mahasiswa Informatika</h1>
            <h2 class="sm:text-3xl text-2xl">UNIVERSITAS SURABAYA</h2>
            <h2 class="sm:text-6xl text-4xl">"We Not Me"</h2>

            <div class="flex text-3xl mt-14">
                <a class="mr-16 text-white bg-black p-3 pr-4 rounded-2xl" href="">Join Us</a>
                <a class="p-3 rounded-2xl border-2 backdrop-blur-sm" href="#navbar">About Us</a>
            </div>
        </div>

        <div id="arrow-scroll" class="text-2xl mt-9">
            <p>Scroll This Page</p>
            <img class="ml-11 w-10 relative" src="images/icon/arrow.svg" type="image/svg+xml" alt="arrow">
        </div>
    </div>

    {{-- NAVBAR --}}
    @include ('layout.mainNavbar')

    {{-- About Us --}}
    <div id="aboutus" class="font-['Jersey10'] md:text-4xl text-2xl m-14">
        <h2 class="text-6xl">ABOUT US</h2>
        <p>An Informatics Engineering student organization, established on the University of Surabaya Campus since 1998. We are located at the TF 4.10 Building, University of Surabaya Tenggilis.</p>
    </div>

    {{-- Our Vision --}}
    <div id="our-vision" class="font-['Jersey10'] md:text-4xl text-2xl grid place-items-center m-14 sm:p-14">
        <h2 class="text-6xl te" >Our Vision</h2>
        <p > To be an organization capable of accommodating, expanding knowledge, and realizing the aspirations of engineering faculty students related to Computer Science.</p>
    </div>

    {{-- DEPARTMENT --}}
    <div id="department" class="font-['Jersey10'] sm:text-3xl text-2xl flex flex-col items-center mb-20">
        <h2 class="text-6xl">DEPARTMENT</h2>

        {{-- Button --}}
        <form action="/our-team" method="GET" class="flex mb-8">
            <button type="submit" class="text-2xl bg-black text-white p-2 pl-4 pr-4 rounded-4xl">
                Let's see our team
            </button>
            <img src="/images/icon/click_this.webp" alt="" class="absolute ml-44">
        </form>

        <div class="w-full grid lg:grid-cols-2 grid-cols-1 gap-14 text-center">
            <div id="department-BPH" class="lg:col-span-2 grid place-items-center">
                <h3 class="sm:text-5xl text-4xl">BPH</h3>
                <h4>(Badan Pengurus Harian)</h4>
                <p>The foundation of the organization that keeps everything aligned—streamlining the flow,</p>
                <p>sustaining the rhythm, and guiding every step forward with purpose and momentum.</p>
                <br>
                <p><i>One movement, driven by four essential roles:</i></p>
                <p class="sm:text-5xl text-3xl">Ketua • Wakil-Ketua • Sekretaris • Bendahara</p>
            </div>

            <div class="grid place-items-center" id="department-IRD">
                <h3 class="sm:text-5xl text-4xl">IRD</h3>
                <h4>(Internal Relation Department)</h4>
                <p>The team that holds KSM IF together.</p>
                <p>Making room for new friendships, real support,</p>
                <p>and growth every step of the way.</p>
            </div>

            <div class="grid place-items-center" id="department-PRD">
                <h3 class="sm:text-5xl text-4xl">PRD</h3>
                <h4>(Public Relation Department)</h4>
                <p>Behind every handshake between KSM IF</p>
                <p>and the outside world. The team who translate ideas into clear communication, contacts into partnerships,</p>
                <p>and keep KSM IF’s image shining bright</p>
            </div>

            <div class="grid place-items-center" id="department-HRDD">
                <h3 class="sm:text-5xl text-4xl">HRDD</h3>
                <h4>(Human Resource Development Department)</h4>
                <p>An organization runs on its people.</p>
                <p>Human Resource Development Department job is to </p>
                <p>help every member update,grow, and unlock their best version.</p>
            </div>

            <div class="grid place-items-center" id="department-CDD">
                <h3 class="sm:text-5xl text-4xl">CDD</h3>
                <h4>(Creative Design Department)</h4>
                <p>Every great moment tells a story.</p>
                <p>The Creative Design Department captures it, preserves it,</p>
                <p>and turns KSM-IF's warmest moments into memories that last.</p>
            </div>
        </div>
    </div>
<script>
    setTimeout(() => {
        $('#header').addClass('text-focus-in');
    }, 1500);

    // belum beres toggle
    document.querySelectorAll('.active')

</script>
@endsection
