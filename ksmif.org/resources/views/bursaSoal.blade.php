@extends('layout.app')

@section('content')
<style>
.typewriter{
  overflow: hidden; /* Ensures the content is not revealed until the animation */
  white-space: nowrap; /* Keeps the content on a single line */
  margin: 0 auto; /* Gives that scrolling effect as the typing happens */
  animation: 
    typing 1s steps(18, end);
}
.blink{
    animation: blink-caret .75s step-end infinite;
}
/* The typing effect */
@keyframes typing {
  from { width: 0; border-right: .15em solid rgb(0, 0, 0);}
  to { width: 100%; border-right: .1em solid transparent;}
}

/* The typewriter cursor effect */
@keyframes blink-caret {
  from, to { border-color: transparent;  }
  50% { border-right: 0.1em solid rgba(0, 0, 0, 0.536);}
}
</style>

<header class="font-['Jersey10'] grid xl:grid-cols-2 md:mx-24 mx-10 my-16 min-h-72">
    <div id="title" class="w-fit min-h-44 m-0">
        <p class="text-4xl hidden">WELCOME TO</p>
        <p class="xl:text-9xl text-7xl hidden">BURSA SOAL</p>
        <p style="margin:0;" class="xl:text-7xl text-5xl hidden w-fit">KSM-IF</p>
    </div>
    
    <form id="formSearch" class="xl:text-4xl text-3xl md:my-8 my-1">
        <div class="mb-0">
            <p class="text-5xl">Cari Soal:</p>
            <input type="text" name="search" id="search" class="border-b" placeholder="cth: Quiz OOP"">
        </div>

        <div>
            <label for="year">Tahun:</label>
            <select name="year" class="underline">
                <option value="all">ALL</option>
                @if(isset($data['tahun']))
			        @foreach($data['tahun'] as $i)
                	<option value="{{$i}}">{{$i}}</option>
                	@endforeach
		        @else
			    <option value="">none</option>
		        @endif
            </select>
            <br class="sm:hidden">
            <label for="matkul">Matkul:</label>
            <select name="matkul" class="underline w-56 text-[1.5rem]">
                <option value="all">ALL</option>
                @foreach ($data['matkul'] as $i)
                <option value="{{$i->id}}">{{$i->nama_matkul}}</option>
                @endforeach
            </select>
        </div>
    </form>
</header>


<div id="selector" class="mx-1.5 border-2 border-dashed grid xl:grid-cols-6 lg:grid-cols-5 md:grid-cols-4 sm:grid-cols-3 grid-cols-2 bg-[#ffffff99] backdrop-blur-xs mb-4 rounded-2xl place-items-center">
    @if($data['bursaSoal'] == false)
        <p>data masih kosong krn admin sedang malas isi data. Isi data mandiri di dashboard admin yeh<br>-Louis :D</p>
    @else
        @foreach($data['bursaSoal'] as $i)
        <div data-file-id="{{$i->path}}"
            data-nama-file="{{$i->nama_file}}"
            data-matkul="{{$i->matkul->nama_matkul}}"
            data-tahun="{{$i->tahun}}"
            data-username="{{$i->users->username}}"
            class="item grid grid-rows-4 max-h-72 max-w-52 bg-white shadow-black shadow-2xl rounded-b-2xl my-4 mx-2 max-w-48">
            <div class="row-span-3 overflow-hidden">
                <img src="https://lh3.googleusercontent.com/d/{{$i->path}}=s300" alt="gambarSoal" referrerpolicy="no-referrer" class="w-full h-full">
            </div>
            <div class="mx-2">
                <p>{{$i->nama_file}}</p>
                <p class="text-zinc-600">{{$i->matkul->nama_matkul}}</p>
            </div>
        </div>
        @endforeach
    @endif
</div>


<div id="viewer" class="z-20 w-screen h-screen top-0 backdrop-blur-xs fixed place-items-center place-content-center font-['Jersey10'] hidden">
    <div class="bg bg-[#212121] rounded-2xl md:flex sm:grid sm:grid-cols-1 sm:h-fit">
        <iframe frameborder="0"
                class="w-full lg:h-[45rem] h-[35rem] p-5 bg-[#999]">
        </iframe>
        
        <div class="grid h-50 text-white text-[1.2rem] md:text-2xl md:mt-12 mx-4 md:w-xl">
            <div class="grid grid-cols-2">
                <p>Nama File</p><p id="viewNamaFile">: pppp</p>
            </div>
            <div class="grid grid-cols-2">
                <p>Matkul</p><p id="viewMatkul">: ppp</p>    
            </div>
            <div class="grid grid-cols-2">
                <p>Tahun</p><p id="viewTahun">: pppp</p>
            </div>
            <div class="grid grid-cols-2">
                <p>Uploaded By</p><p id="viewUploadedBy">: ppp</p>
            </div>
            <div class="grid grid-cols-2 h-fit mx-12 md:mx-0">
                <div class="bg-green-600 w-fit p-1 md:p-2 m-2">      
                    <a class="flex">
                        Downloads
                        <img src="/images/icon/download.svg" alt="Download btn" class="h-8 pl-2">
                    </a>
                </div>
                <div id="cancelView" class="border border-e-amber-50 p-1 md:p-2 m-2 text-center">
                    <p>Cancel</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let title = $('#title > p');
title.eq(0).removeClass('hidden');

for(let i=0; i < title['length']; i++){
    let timeout = 1500 * (i+1);
    setTimeout(() => {
        title.eq(i).removeClass('hidden');
        title.eq(i).addClass('typewriter');
    }, timeout);

    if((title['length']-1) == i){
        setTimeout(()=>{
            title.eq(i).addClass('blink');
        }, 4000);
    }
}

$('#formSearch select, #formSearch input').on('change', function() {
    $('#formSearch').submit();
});

$('#formSearch').on('submit', function(e){
    e.preventDefault();

    $.ajax({
    type: "GET",
    url: "/bursa-soal/by",
    data: $(this).serialize(),
    dataType    : "json",
    success: function (res) {
            let list = '';
            res.result.forEach(e => {
                list +=
                `<div data-file-id="${e.path}"
                    data-nama-file="${e.nama_file}"
                    data-matkul="${e.matkul.nama_matkul}"
                    data-tahun="${e.tahun}"
                    data-username="${e.username}"
                    class="item grid grid-rows-4 max-h-72 max-w-52 bg-white shadow-black shadow-2xl rounded-b-2xl my-4 mx-2 max-w-48">
                    <div class="row-span-3 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/d/${e.path}=s300" alt="gambarSoal" referrerpolicy="no-referrer" class="w-full h-full">
                    </div>
                    <div class="mx-2">
                        <p>${e.nama_file}</p>
                        <p class="text-zinc-600">${e.matkul.nama_matkul}</p>
                    </div>
                </div>`;
            });
            $('#selector').html(list);
        }
    });
});

$("#selector").on("click",".item", function(){
    let id       = $(this).data("fileId");  
    let namaFile = $(this).data("namaFile");
    let matkul   = $(this).data("matkul");
    let tahun    = $(this).data("tahun");
    let usrname  = $(this).data("username");
    $("#viewer iframe").attr("src", `https://drive.google.com/file/d/${id}/preview`);
    $("#viewer a").attr("href", `https://drive.usercontent.google.com/u/0/uc?id=${id}&export=download`);
    $("#viewNamaFile").text(`: ${namaFile}`);
    $("#viewMatkul").text(`: ${matkul}`);
    $("#viewTahun").text(`: ${tahun}`);
    $("#viewUploadedBy").text(`: ${usrname}`);
    $("#viewer").fadeIn();
});

$("#cancelView").click(function(){
    $("#viewer").fadeOut();
});
</script>
@endsection
