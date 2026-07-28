<nav id="navbar" class="font-['Jersey10'] m-2.5 text-3xl sticky top-2 rounded-2xl z-3">
    <div id="desktop-nav" class="flex justify-between">
        <div id="desktop-nav-menu" class="flex w-fit border-4 border-dashed rounded-2xl gap-12 backdrop-blur-sm bg-[#ffffff99]">
            <a href="/" class="nav-link flex p-2.5 w-fit rounded-2xl">
                <img class="h-9" src="/images/icon/home.svg" alt="" type="image/svg+xml">
                <p>Homepage</p>
            </a>
            <a href="/our-team" class="nav-link flex p-2.5 w-fit rounded-2xl">
                <img class="h-9" src="/images/icon/people.svg" alt="" type="image/svg+xml">
                <p>Our Team</p>
            </a>
            <a href="/bursa-soal" class="nav-link flex p-2.5 w-fit rounded-2xl">
                <img class="h-9" src="/images/icon/book.svg" alt="" type="image/svg+xml">
                <p>Bursa Soal</p>
            </a>
        </div>
        <div class="m-2.5 h-fit">
            @if($data['auth'])
            <a id="dashboard" href="/dashboard/editMember" class="bg-black text-white p-2 rounded-2xl">
                Dashboard
            </a>
            @else    
            <a id="desktop-loginBtn" class="bg-black text-white p-2 rounded-2xl">
                SignUp / LogIn
            </a>
            @endif
        </div>
    </div>
    
    <div class="backdrop-blur-sm bg-[#ffffff99]">    
        <div id="mobile-nav" class="p-2 nav-link flex border-4 border-dashed rounded-2xl">
            <img class="h-9 ml-3" src="/images/icon/menu.svg" alt="" type="image/svg+xml">
        </div>
        <div id="mobile-nav-menu" class="rounded-2xl border-2 border-[#00000039] hidden">
            <a href="/" class="nav-link flex p-2.5 w-full rounded-2xl border-b-2 shadow-sm shadow-gray-950">
                <img class="h-9" src="/images/icon/home.svg" alt="" type="image/svg+xml">
                <p>Homepage</p>
            </a>
            <a href="/our-team" class="nav-link flex p-2.5 w-full rounded-2xl border-b-2 shadow-sm shadow-gray-950">
                <img class="h-9" src="/images/icon/people.svg" alt="" type="image/svg+xml">
                <p>Our Team</p>
            </a>
            <a href="/bursa-soal" class="nav-link flex p-2.5 w-full rounded-2xl border-b-2 shadow-sm shadow-gray-950">
                <img class="h-9" src="/images/icon/book.svg" alt="" type="image/svg+xml">
                <p>Bursa Soal</p>
            </a>
            @if ($data['auth'])
            <a id="dashboard" href="/dashboard/editMember" class="nav-link flex p-2.5 w-full rounded-2xl border-b-2 shadow-sm shadow-gray-950">
                Dashboard
            </a>
            @else  
            <a id="mobile-loginBtn" href="" class="nav-link flex p-2.5 w-full rounded-2xl border-b-2 shadow-sm shadow-gray-950">
                Login / SignUp
            </a>
            @endif
        </div>
    </div>
</nav>

<div id="loginPanel" class="fixed top-0 z-7 h-screen w-screen grid-cols-1 place-content-center place-items-center backdrop-blur-sm font-['Jersey10'] hidden">
    <form method="POST" action="/user-login" class="bg-white h-96 w-96 border rounded-2xl text-center text-4xl">
        @csrf
        <img id="closeLoginBtn" src="/images/icon/close.svg" alt="closeBtn" class="absolute ml-2 my-2">
        <p class="text-5xl my-3">Welcome!</p>
        <div>
            <input type="text" name="username" id="username" placeholder="Username" class="border-b-2 text-center my-3" required>
            <input type="password" name="password" id="password"  placeholder="Password" class="border-b-2 text-center my-3" onkeydown="if(e.key==='Enter'){e.preventDefault();}" required>
            <img  id="eyeIcon" src="/images/icon/eye.svg" alt="eye" class="fixed -mt-12 ml-80" onclick="togglePassword()">
        </div>
        <button type="submit" class="bg-black py-4 w-[70%] text-white">Login</button>
    </form>
</div>
<script>
    let mobileMenuClick = false;
    $('#mobile-nav').click(function () { 
        if(!mobileMenuClick){
            $('#mobile-nav-menu').stop().slideDown(300);
            mobileMenuClick = true;
        }else{
            $('#mobile-nav-menu').stop().slideUp(300);
            mobileMenuClick = false;
        }
    });

    $('.nav-link').hover(function(){
            // over
            $(this).addClass('nav-hover');
            // console.log("hover");       
        }, function() {
            // out
            $(this).removeClass('nav-hover');
            // console.log("out");
        }
    );
    
    let indexNav = @json($data['navbar']);
    if(indexNav == 'ourTeam'){
        $('nav-link').removeClass('nav-click');
        $('.nav-link').eq(1).addClass('nav-click');
    }
    else if(indexNav == 'bursaSoal'){
        $('nav-link').removeClass('nav-click');
        $('.nav-link').eq(2).addClass('nav-click');
    }
    else{
        $('nav-link').removeClass('nav-click');
        $('.nav-link').eq(0).addClass('nav-click');
    }

    $("#mobile-loginBtn").click(function (e) { 
        e.preventDefault();
        $('#loginPanel').removeClass('hidden');
        $('#mobile-nav-menu').attr('hidden', 'true');
        mobileMenuClick = true;
    });

    $("#desktop-loginBtn").click(function (e) { 
        e.preventDefault();
        $('#loginPanel').removeClass('hidden');
    });

    $("#closeLoginBtn").click(function (e) { 
        e.preventDefault();
        $('#loginPanel').addClass('hidden');
    });

    $('#username').keydown(function (e) { 
        if(e.key=="Enter"){
            e.preventDefault();
            $('#password').focus();
        }
    });

    function togglePassword() {
        let input = document.getElementById("password");
        console.log(input);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>
<style>
    .nav-hover{
        color : white;
        background-color: rgba(0, 0, 0, 0.683);
    }
    .nav-hover img {
    filter: invert(1);
    }

    .nav-click{
        color : white;
        background-color: rgb(0, 0, 0);
    }
    .nav-click img {
    filter: invert(1);
    }    
</style>