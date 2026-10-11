<div id="ksmif-countdown-popup"
     class="fixed inset-0 z-[100000] flex items-center justify-center p-5 bg-black/70 backdrop-blur-[6px] cursor-pointer font-['Jersey10'] animate-[ksmif-fade_.3s_ease] motion-reduce:animate-none"
     role="dialog"
     aria-modal="true"
     aria-label="Open Registration KSM-IF Batch I"
     style="display: none;">

    <div class="ksmif-card box-border w-full max-w-[640px] max-h-full overflow-y-auto px-7 pt-11 pb-9 text-center text-black bg-white rounded-[14px] shadow-[0_24px_80px_rgba(0,0,0,.45)] cursor-default max-[600px]:max-w-[420px] max-[600px]:max-h-[calc(100dvh-32px)] max-[600px]:px-4 max-[600px]:py-7">
        <img class="ksmif-logo block w-[min(150px,40%)] h-auto mx-auto mb-[18px] max-[600px]:w-[min(120px,40%)] max-[600px]:mb-3.5"
             src="{{ asset('images/icon/ksmHytam.svg') }}"
             alt="Logo KSM-IF Universitas Surabaya">

        <p class="ksmif-subtitle m-0 p-0 text-[1rem] uppercase">Kelompok Studi Mahasiswa Informatika</p>
        <h2 class="ksmif-title m-0 p-0 text-black md:text-5xl sm:text-4xl text-3xl font-bold ">"Open Registration"</h2>
        <p class="ksmif-batch m-0 p-0 text-3xl font-bold">11 OKT - <span id="coret-tanggal">17 OKT</span> 2026</p>
        <img src="{{ asset('images/icon/EXTEND_oprec.webp')}}" alt="oprec_icon" class="absolute w-48 h-auto -rotate-24 ml-[22.5rem] -mt-14 hidden"/>

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

        <div class="ksmif-actions flex flex-wrap justify-center gap-3 max-[600px]:gap-2.5">
            <a class="ksmif-btn inline-block px-8 py-4 border border-[#1c1c1c] rounded-2xl text-2xl font-extrabold no-underline text-white bg-[#1c1c1c] hover:shadow-xl/50" href="https://bit.ly/OPENRECRUITMENT_ORMAWAFT2627">Join Us</a>
            <a class="ksmif-btn inline-block px-8 py-4 border border-[#1c1c1c] rounded-2xl text-2xl font-extrabold no-underline text-[#1c1c1c] bg-white hover:shadow-xl/50" href="#navbar">About Us</a>
        </div>

        <button type="button" class="ksmif-btn mt-5 p-0 text-black text-2xl font-extrabold underline">
            back to homepage
        </button>
    </div>
</div>

<style>
    @keyframes ksmif-fade {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>

<script>
$(function () {
    const $popup = $('#ksmif-countdown-popup');

    if (!$popup.length || $popup.data('initialized') === true) return;
    $popup.data('initialized', true);

    const sessionKey = 'ksmif_countdown_closed';
    const $close = $('.ksmif-btn');

    const $d = $('#ksmif-days');
    const $h = $('#ksmif-hours');
    const $m = $('#ksmif-minutes');
    const $s = $('#ksmif-seconds');

    // GANTI dengan tanggal dan waktu registrasi yang sebenarnya.
    // Format: YYYY-MM-DDTHH:mm:ss+07:00 (Waktu Indonesia Barat).
    let targetDate = new Date('2026-10-18T00:00:01+07:00').getTime();

    if(Date.now() >= targetDate){
        targetDate = new Date('2026-10-20T00:00:01+07:00').getTime();
        $(".ksmif-timer").eq(0).css("margin-top", "calc(var(--spacing) * 5)");
        $("img[alt='oprec_icon']").removeClass("hidden");
        $("#coret-tanggal").css("text-decoration-color", "var(--color-red-500)").css("text-decoration-line", "line-through");
    }

    let timerInterval = null;
    let closed = false;

    const pad = (value) => String(value).padStart(2, '0');

    function wasClosed() {
        try {
            return sessionStorage.getItem(sessionKey) === '1';
        } catch (error) {
            return false;
        }
    }

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

    function closePopup() {
        if (closed) return;
        closed = true;

        try {
            sessionStorage.setItem(sessionKey, '1');
        } catch (error) {
            // Popup tetap bisa ditutup jika penyimpanan sesi tidak tersedia.
        }

        if (timerInterval !== null) {
            clearInterval(timerInterval);
            timerInterval = null;
        }

        $popup.remove();
        $(document).off('keydown.ksmif');
    }

    // Hanya klik area gelap di luar kartu yang langsung menutup popup.
    // Link Join Us dan About Us tetap dapat diklik.
    $popup.on('click', function (event) {
        if (event.target === this) {
            closePopup();
        }
    });

    $close.on('click', closePopup);
    $(document).on('keydown.ksmif', function (event) {
        if (event.key === 'Escape') {
            closePopup();
        }
    });

    updateCountdown();
    timerInterval = setInterval(updateCountdown, 1000);

    function loadingIsFinished() {
        // Selector umum untuk beberapa pola loading.
        const $loading = $('#loading, #loader, .loading-screen, .loading-overlay, .loader').first();

        // Jika tidak ada elemen loading yang cocok, anggap loading selesai.
        if (!$loading.length) return true;

        const display = $loading.css('display');
        const visibility = $loading.css('visibility');
        const opacity = parseFloat($loading.css('opacity'));

        return display === 'none' ||
            visibility === 'hidden' ||
            opacity === 0 ||
            $loading.width() === 0 ||
            $loading.height() === 0;
    }

    function showPopup() {
        if (closed || !$.contains(document, $popup[0])) return;

        if (wasClosed()) {
            $popup.remove();
            return;
        }

        $popup.css('display', 'flex');
    }

    function waitForLoading() {
        if (closed || !$.contains(document, $popup[0])) return;

        if (wasClosed()) {
            $popup.remove();
            return;
        }

        if (loadingIsFinished()) {
            showPopup();
            return;
        }

        requestAnimationFrame(waitForLoading);
    }

    // Tunggu seluruh aset halaman selesai dimuat terlebih dahulu.
    if (document.readyState === 'complete') {
        waitForLoading();
    } else {
        $(window).on('load', waitForLoading);
    }
});
</script>
