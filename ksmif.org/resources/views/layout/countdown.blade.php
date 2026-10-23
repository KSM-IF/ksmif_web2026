@extends('layout.app')

@section('content')
<div class="font-['Jersey10'] w-screen h-screen text-center text-black bg-white rounded-[14px]">
    <div class="xl:pt-[5%] md:pt-[10%] sm:pt-[20%] pt-[30%]">
        <img class="ksmif-logo block w-[min(150px,40%)] h-auto mx-auto mb-[18px] max-[600px]:w-[min(120px,40%)] max-[600px]:mb-3.5"
             src="{{ asset('images/icon/ksmHytam.svg') }}"
             alt="Logo KSM-IF Universitas Surabaya">

        <p class="ksmif-subtitle m-0 p-0 text-[1rem] uppercase">Kelompok Studi Mahasiswa Informatika</p>
        <h2 class="ksmif-title m-0 p-0 text-black md:text-7xl sm:text-4xl text-3xl font-bold ">ANNOUNCEMENT</h2>

        <div class="ksmif-timer flex items-baseline justify-center gap-[clamp(4px,1.5vw,10px)] my-2 mb-7 mt-5 tabular-nums max-[600px]:w-full max-[600px]:gap-1 max-[600px]:my-6 max-[600px]:px-1.5"
             aria-label="Waktu menuju pembukaan registrasi">
            <span class="ksmif-unit">
                <b id="ksmif-days" class="text-7xl font-bold">00</b>
                <i class="ml-0.5 text-2xl font-bold">d</i>
            </span>
            <span class="ksmif-sep text-2xl">:</span>
            <span class="ksmif-unit">
                <b id="ksmif-hours" class="text-7xl font-bold">00</b>
                <i class="ml-0.5 text-2xl font-bold">h</i>
            </span>
            <span class="ksmif-sep text-2xl">:</span>
            <span class="ksmif-unit">
                <b id="ksmif-minutes" class="text-7xl font-bold">00</b>
                <i class="ml-0.5 text-2xl font-bold">m</i>
            </span>
            <span class="ksmif-sep text-2xl">:</span>
            <span class="ksmif-unit">
                <b id="ksmif-seconds" class="text-7xl font-bold">00</b>
                <i class="ml-0.5 text-2xl font-bold">s</i>
            </span>
        </div>

        <h2 class="sm:text-4xl text-2xl">Meet Our Past Members</h2>
        <form action="/our-team/by" method="GET" id="menuSelect" class="grid grid-cols-2 w-96 max-w-full place-items-center mx-auto pb-2">
            <div class="text-center xl:text-4xl text-2xl">
                <select name="period" id="priod" onchange="this.form.submit()" class="underline">
                    @foreach ($data['period'] as $i)
                        <?php $val=""; ?>
                        @if(isset($data['selectedItem']['period']) && $i==$data['selectedItem']['period']){
                            <?php $val = 'selected';?>
                        }
                        @endif
                    <option value={{$i}} {{$val}}>{{$i}}</option>
                    @endforeach
                </select>
                <p>Periode</p>
            </div>
            
            <div class="text-center xl:text-4xl text-2xl">
                <select name="division" id="division" onchange="this.form.submit()" class="underline">
                    @foreach ($data['division'] as $i)
                        <?php $val=""; ?>
                        @if(isset($data['selectedItem']['division']) && $i==$data['selectedItem']['division'])
                            <?php $val = 'selected';?>
                        @endif
                        <option value={{$i}} {{$val}}>{{$i}}</option>
                    @endforeach
                </select>
                <p>Division</p>
            </div>
        </form>

        <button type="button" class="ksmif-btn mt-5 p-0 text-black text-2xl font-extrabold underline">
            back to homepage
        </button>
    </div>
</div>
<script>
const $d = $('#ksmif-days');
const $h = $('#ksmif-hours');
const $m = $('#ksmif-minutes');
const $s = $('#ksmif-seconds');

// GANTI dengan tanggal dan waktu registrasi yang sebenarnya.
// Format: YYYY-MM-DDTHH:mm:ss+07:00 (Waktu Indonesia Barat).
let targetDate = new Date(@json($data['end'])).getTime();
let timerInterval = null;
let closed = false;
const pad = (value) => String(value).padStart(2, '0');
updateCountdown();
timerInterval = setInterval(updateCountdown, 1000);

function updateCountdown() {
    const remaining = Math.max(0, targetDate - Date.now());

    $d.text(pad(Math.floor(remaining / 86400000)));
    $h.text(pad(Math.floor((remaining % 86400000) / 3600000)));
    $m.text(pad(Math.floor((remaining % 3600000) / 60000)));
    $s.text(pad(Math.floor((remaining % 60000) / 1000)));

    if (remaining <= 0 && timerInterval !== null) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
}

$('.ksmif-btn').click(function(){
    window.location.href='https://ksmif.org';
});
</script>
@endsection
