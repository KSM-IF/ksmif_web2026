@extends('dashboard.layout.layout')

@section('content')
<h1>Tambah / Edit Bursa Soal</h1>

<div class="border m-4 p-4">
    <h2>Tambah Bursa</h2>
    <form  id="submitFile" action="/dashboard/editBursa" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-2">
            <label for="namaFile">Nama file:</label>
            <input type="text" name="namaFile" id="namaFile" class="border-b" placeholder="Ex:UAS OOP" required>
        </div>
        <div class="m-2">
            <label for="file">Upload File:</label>
            <input type="file" name="file" id="file" class="border" required>
        </div>
        <div>
            <label for="tahun">Tahun:</label>
            <input type="number" name="tahun" id="tahun">
        </div>
        <div class="m-2">
            <label for="matkul">Matkul:</label>
            <select name="matkul" id="matkul" required>
                <option value="" disabled selected hidden>pilih matkul dulu mass</option>
                @foreach($data['matkul'] as $i)
                <option value="{{$i->id}}">{{$i->nama_matkul}}</option>
                @endforeach
            </select>
        </div>
        <div class="m-2">
            <label for="tipe">Tipe :</label>
            <select name="tipe" id="tipe" required>
                <option value="" disabled selected hidden>pilih tipe dulu :v</option>
                @foreach($data['tipe'] as $i)
                <option value="{{$i}}">{{$i}}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Submit</button>
    </form>
</div>

<div>
    <table class="m-4">
        <thead>
            <tr><th colspan="7" class="border">Edit Bursa</th></tr>
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Nama File</th>
                <th class="p-2 border">Tipe</th>
                <th class="p-2 border">Matkul</th>
                <th class="p-2 border">Tahun</th>
                <th class="p-2 border">Uploaded By</th>
                <th class="p-2 border">Upload</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        
        <tbody id="dataBursa">
            @forEach($data['bursaSoal'] as $i)
            <tr>
                <td class="p-2 border">{{$i['id']}}</td>
                <td class="p-2 border">{{$i['namaFile']}}</td>
                <td class="p-2 border">{{$i['tipe']}}</td>
                <td class="p-2 border">{{$i['matkul']->nama_matkul}}</td>
                <td class="p-2 border">{{$i['tahun']}}</td>
                <td class="p-2 border">{{$i['user']->full_name}}</td>
                <td class="p-2 border">{{$i['uploadAt']}}</td>
                <td class="p-2 border flex">
                    <p data-id="{{$i['id']}}" class="delete">Delete</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    let now = (new Date).getFullYear();
    $("#tahun").val(now); 
    $("#tahun").attr("max", now);

    let submitClick = false;
    $("#submitFile").on('submit',function(e) {
        e.preventDefault();
        if(submitClick){
            alert("SABAR ANYING MASIH UPLOADD!!!\n😊");
            return 0;
        }

        submitClick = true;

        alert("Sabar mas masih upload!!!\nJangan spam ya, nanti bakal di notif kok kalo udh selesai / gagal :D");
        let fData    = new FormData(this);

        $.ajax({
            type        : "POST",
            url         : "/dashboard/editBursa",
            data        : fData,
            dataType    : "json",
            processData : false,
            contentType : false,
            success : function (res) {
                console.log(res['pesan']);
                alert(res['pesan']);
                location.reload();
            },
             error: function (xhr) {
                alert('Error: ' + xhr.responseJSON?.pesan || 'Terjadi kesalahan');
                location.reload();
            }
        });
    });

    $("#dataBursa").on("click",".delete", function(){
        let id   = $(this).data("id");
        let data = {'id': id, '_method': 'DELETE'};
        alert("Sabar masih on posess....");

        $.ajax({
            type: "POST",
            url: "/dashboard/editBursa",
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            data: data,
            dataType: "json",
            success: function (res) {
                alert(res['pesan']);
                location.reload();
            },error: function (xhr) {
                alert('Error: ' + xhr.responseJSON?.pesan || 'Terjadi kesalahan');
            }
        });
    });
</script>

@endsection