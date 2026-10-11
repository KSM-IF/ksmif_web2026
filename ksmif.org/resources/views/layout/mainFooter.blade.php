<footer class="h-fit p-9 text-white bg-[#353535] font-['Jersey10'] sm:text-2xl text-[15px] flex gap-[50%] relative bottom-0">
    <div>
        <h1 class="text-5xl">Contact Us</h1>

        <div class="flex gap-1.5">
            <img src="/images/icon/mail.svg"></img>
            <a href='mailto:{{getenv('MAIL_USERNAME');}}'>EMAIL : {{getenv('MAIL_USERNAME');}}</a>
        </div>
        
        <div class="flex gap-1.5">
            <img src="/images/icon/phone.svg">
            <div>
                <button type="button" class="whatsapp-button" data-contact="Kevin">PHONE : +62 812-2918-5198 (Kevin)</button><br>
                <button type="button" class="whatsapp-button" data-contact="Jesslyn">PHONE : +62 822-1167-9988 (Jesslyn)</button>
            </div>
        </div>


        <div class="flex gap-1.5">
            <img style="height: 24px" src="/images/icon/instagram.svg">
            <a href="https://instagram.com/ksm_informatika">INSTAGRAM : @ksm_informatika</a>
        </div>

        <div class="flex gap-1.5">
            <img style="height: 24px; filter: invert(100%);"src="/images/icon/github.webp" alt="github">
            <a href="https://github.com/KSM-IF">Github : https://github.com/KSM-IF</a>
        </div>

        <div class="flex gap-1.5">
            <img style="height: 24px" src="/images/icon/line.svg">
            <div>
                <p>LINE : @zkfz_087 (Kevin)</p>
                <p>Line : @jesslena07 (Jesslyn)</p>
            </div>
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

$('.whatsapp-button').on("click", function () {
    let contact = $(this).data('contact');
    let phone = "";
    let message = encodeURIComponent(
`Halo Admin KSM-IF!!
Perkenalkan Saya
Nama     : 
NRP      : 
Fakultas : 
Jurusan  : 
Angkatan :
Keperluan :`);

    if(contact == 'Kevin'){
        phone = 6281229185198;
    }else{
        phone = 6282211679988;
    }

    window.open("https://wa.me/" + phone + "?text=" + message, "_blank");
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