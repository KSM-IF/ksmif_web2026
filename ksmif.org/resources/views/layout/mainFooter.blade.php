<footer class="h-fit p-9 text-white bg-[#353535] font-['Jersey10'] sm:text-2xl text-[15px] flex gap-[50%] relative bottom-0">
    <div>
        <h1 class="text-5xl">Contact Us</h1>

        <div class="flex gap-1.5">
            <img src="/images/icon/mail.svg"></img>
            <a href='mailto:{{getenv('MAIL_USERNAME');}}'>EMAIL : {{getenv('MAIL_USERNAME');}}</a>
        </div>
        
        <div class="flex gap-1.5">
            <img src="/images/icon/phone.svg">
            <a href="">PHONE : 0812345678</a>
        </div>

        <div class="flex gap-1.5">
            <img style="height: 24px" src="/images/icon/instagram.svg">
            <a href="https://instagram.com/ksm_informatika">INSTAGRAM : @ksm_informatika</a>
        </div>
        <div class="flex gap-1.5">
            <img style="height: 24px" src="/images/icon/line.svg">
            <a href="">LINE : @test</a>
        </div>
        <p class="text-[15px]">
        Copyright © KSM-IF 2026 <br>
        Made with love from CDD & HRDD
        </p>
    </div>
    <div class="sm:mt-6">
        <h2 class="text-3xl">Presented By:</h2>
        <div class="flex gap-2">
            <a href="https://ubaya.ac.id"><img style="height:40px" src="/images/icon/logo-ubaya-w.webp" alt="logo-ubaya"></a>
            <a href="https://if.ubaya.ac.id/"><img style="height:35px; filter:brightness(0%) invert(100%)" src="/images/icon/Logo-Teknik-Informatika.webp"></a>
            <img style="height:40px; filter:invert(100%)" src="/images/icon/ksmHytam.svg">
        </div>
    </div></a>
</footer>
<script>
$(document).ready(responsiveDocs);
$(window).resize(function(){
    responsiveDocs();
});

function responsiveDocs(){
    let docWidth  = $(document).width();
    let winHeight = $(window).height();
    //console.log(winHeight);
    if(docWidth<1260){
        $('#desktop-nav').attr('hidden', '');
        $('#mobile-nav').removeAttr('hidden');
        $('footer').removeClass('flex');
    }else {
        $('#mobile-nav').attr('hidden', '');
        $('#desktop-nav').removeAttr('hidden');
        $('#mobile-nav-menu').attr('hidden', 'true');
        $('footer').addClass('flex');
    }
}
</script>