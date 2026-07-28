@extends('dashboard.layout.layout')

@section('content')
<h1>Tambah / Edit Bursa Soal</h1>

<div class="border m-4 p-4">
    <h2>Tambah Bursa</h2>
    <form  id="submitFile" action="/dashboard/editBursa" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="m-2">
            <label for="namaFile">Nama file:</label>
            <input type="text" name="namaFile" id="namaFile" class="border-b" required>
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
                @foreach($data['matkul'] as $i)
                <option value="{{$i->id}}">{{$i->nama_matkul}}</option>
                @endforeach
            </select>
        </div>
        <div class="m-2">
            <label for="tipe">Tipe :</label>
            <select name="tipe" id="tipe" required>
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
            <tr><th colspan="5" class="border">Edit Bursa</th></tr>
            <tr>
                <th class="p-2 border">ID</th>
                <th class="p-2 border">Matkul</th>
                <th class="p-2 border">Uploaded By</th>
                <th class="p-2 border">Tahun</th>
                <th class="p-2 border">Action</th>
            </tr>
        </thead>
        
        <tbody>
            @forEach($data['bursaSoal'] as $i)
            <tr>
                <td class="p-2 border">{{$i['id']}}</td>
                <td class="p-2 border">{{$i['matkul']->nama_matkul}}</td>
                <td class="p-2 border">{{$i['user']->full_name}}</td>
                <td class="p-2 border">{{$i['tahun']}}</td>
                <td class="p-2 border">
                    <input type="button" data-idBursa="{{$i['id']}}" value="Edit"> |
                    <input type="button" data-idBursa="{{$i['id']}}" value="Delete">
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

    $("#submitFile").on('submit',function(e) {
        e.preventDefault();

        alert("SABAR MASS LAGI UPLOAD!!!\nJangan spam ya, nanti bakal di notif kok kalo udh selesai :D");
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
            }
        });
    });
</script>

@endsection