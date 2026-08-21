@extends('dashboard.layout.layout')

@section('content')
<h1>New User</h1>
<form id="newUser" class="grid grid-cols-2" enctype="multipart/form-data">
    @csrf
    <section class="max-w-96">
        <div>
            <label for="fullname">Full Name :</label>
            <input type="text" name="fullname" style="border-bottom: 1px black solid;" required>
        </div>
        <div>
            <label for="username">Username :</label>
            <input type="text" name="username" style="border-bottom: 1px black solid;" required>
        </div>
        <div>
            <label for="username">Password :</label>
            <input type="text" name="password" style="border-bottom: 1px black solid;" required>
        </div>
        <div>
            <label for="email">Email :</label>
            <input type="text" name="email" style="border-bottom: 1px black solid;" required>
        </div>
        <div>
            <label for="nrp">NRP :</label>
            <input type="text" name="nrp" style="border-bottom: 1px black solid;" required>
        </div>
        <div>
            <label for="status">Status :</label>
            <select name="status">
                <option value="true">true</option>
                <option value="false">false</option>
            </select>
        </div>
    </section>
    <section>
        <div>
            <label for="periode">Periode</label>
            <input type="number" name="periode" class="border" required>
        </div>
        <div>
            <label for="division">Divisi : </label>
            <select name="division" class="division" required>
                <option value="" disabled selected hidden>pilih divisi dulu</option>    
                <option value="BPH">BPH</option>
                <option value="IRD">IRD</option>
                <option value="PRD">PRD</option>
                <option value="HRDD">HRDD</option>
                <option value="CDD">CDD</option>
            </select>
        </div>
        <div>
            <label for="role">Role :</label>
            <select name="role" class="role" required>       
                <option value="" disabled selected hidden>pilih divisi dulu</option>       
            </select>
        </div>
        <div>
            <label for="photo">Upload Photo: </label>
            <input type="file" name="photo" accept="image/*" class="border-b">
        </div>
        <div></div>
    </section>
    <button id="saveUser" type="submit" class="bg-black p-2 text-white rounded-2xl text-2xl">Save</button>
</form>
<script>
let submitClick = false;
const roleBPH = ['Ketua','Wakil Ketua', 'Sekretaris', 'Bendahara'];
const roleReg = ['Koor', 'WaKoor', 'Anggota'];

$('select[name="division"]').on("change",function(){
    let div = $('select[name="division"]').val();
    
    let role ='';
    if(div == "BPH"){
        roleBPH.forEach(element =>{
            role += `<option value="${element}">${element}</option>\n`;
        });
    }else{
        roleReg.forEach(element =>{
            role += `<option value="${element}">${element}</option>\n`;
        });
    }

    $('select[name="role"]').html(role);
});


$("#newUser").on("submit", function(e){
    e.preventDefault();
    let fdata = new FormData(this);
    if(submitClick) {
        alert("SABAR ANYING MASIH UPLOAD!!!\n😊");
        return 0;
    }
    submitClick = true;
    alert("Upload data...");

    $.ajax({
        type: "POST",
        url: "/dashboard/newMember/user",
        data: fdata,
        dataType: "json",
        processData: false,
        contentType: false,
        headers:{
            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
        },
        success: function (res) {
            if(res.status === true){
                    alert("tambah data success!!");
                    console.log(res);
                    // window.location.replace("/dashboard/editMember/user/by?id="+res.user);
            }else{
                console.log(res);
            }
        },
        error: function(xhr) {
            console.log('Error:', xhr.responseText);
        }
    });
});
</script>
@endsection