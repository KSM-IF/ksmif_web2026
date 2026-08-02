@extends('dashboard.layout.layout')

@section('content')
<div class="mx-4 my-4 overflow-y-auto">
    <table id="tableUsers">
        <thead>
            <tr><th colspan="10" class="border">Edit Members</th></tr>
            <tr>
                    @csrf
                    <th colspan="5" class="border">
                        <label for="tahun">Tahun</label>
                        <select name="tahun" id="tahun" class="memberSelector">
                            @foreach ($data['allPeriode'] as $i)
                                @if(isset($data['tahun']) && $i == $data['tahun'])
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif    
                            @endforeach
                        </select>
                    </th>
                    <th colspan="5" class="border">
                        <label for="divisi">Divisi</label>
                        <select name="divisi" id="divisi" class="memberSelector">
                            @foreach ($data['allDivision'] as $i)
                                @if(isset($data['tahun']) && $i == $data['divisi'])
                                    <option value="{{$i}}" selected>{{$i}}</option>
                                @else
                                    <option value="{{$i}}">{{$i}}</option>
                                @endif    
                            @endforeach
                        </select>
                    </th>
            </tr>
            <tr>
                <th class="border p-2">ID</th>
                <th class="border p-2">Username</th>
                <th class="border p-2">Full Name</th>
                <th class="border p-2">Photo</th>
                <th class="border p-2">NRP</th>
                <th class="border p-2">Email</th>
                <th class="border p-2">Division</th>
                <th class="border p-2">Role</th>
                <th class="border p-2">Status</th>
                <th class="border p-2">Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data['member'] as $i)
            <tr>
                    @csrf
                    <td class="border p-2  max-w-20">{{$i['id']}}</td>
                    <td class="border p-2 ">{{$i['username']}}</td>
                    <td class="border p-2 ">{{$i['full_name']}}</td>
                    <td class="border p-2 max-w-56"><img src="https://lh3.googleusercontent.com/d/{{$i['display_photo']}}=s150" loading="lazy" referrerpolicy="no-referrer" alt="member_photo"></td>
                    <td class="border p-2  max-w-32">{{$i['NRP']}}</td>
                    <td class="border p-2 ">{{$i['email']}}</td>
                    <td class="border p-2 max-w-8">{{$i['division']}}</td>
                    <td class="border p-2 max-w-32">{{$i['role']}}</td>
                    <td class="border p-2 max-w-4">
                        @if($i['status']??true)True
                        @else False
                        @endif
                    </td>
                    <td class="border p-2">
                        <button class='edit-btn border-b' type="button" data-id="{{$i['user_id']}}">EDIT</button>
                    </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div id="editDataUser" hidden>
    </div>
</div>


<script>
let user;
let divisionOption = ['BPH', 'IRD', 'PRD', 'HRDD', 'CDD'] ;
let roleBPH = ['Ketua','Wakil Ketua', 'Sekretaris', 'Bendahara'];
let roleReg = ['Koor', 'WaKoor', 'Anggota'];

$('.edit-btn').click(function (e) { 
    e.preventDefault();
    let id = $(this).data('id');
    
    $.ajax({
        type: "GET",
        url: "/dashboard/editMember/user/by?id="+id,
        success: function (response) {
            user = response.user;
            let userStatus;

            if(user.status != 1){
                userStatus =
                `<option value="true">TRUE</option>
                <option value="false" selected >FALSE</option>`;
            }else{
                userStatus =
                `<option value="true" selected >TRUE</option>
                <option value="false">FALSE</option>`;
            }

            let formEditUser =
            `<form action="/dashboard/editMember/by?user-id=${user.id}" method="POST">
                <p>ID : ${user.id}</p>
                <div>
                    <label for="fullname">Full Name :</label>
                    <input type="text" name="fullname" value="${user.full_name}" style="border-bottom: 1px black solid;">
                </div>
                <div>
                    <label for="username">Username :</label>
                    <input type="text" name="username" value="${user.username}" style="border-bottom: 1px black solid;">
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="text" name="email" value="${user.email}" style="border-bottom: 1px black solid;">
                </div>
                <div>
                    <label for="nrp">NRP :</label>
                    <input type="text" name="nrp" value="${user.NRP}" style="border-bottom: 1px black solid;">
                </div>
                <div>
                    <label for="status">Status :</label>
                    <select name="status">
                        ${userStatus}
                    </select>
                </div>
                <p>Created at: ${user.created_at}</p>
                <p>Updated at: ${user.updated_at}</p>
                <button id="saveUser" type="button" class="bg-black p-2 text-white rounded-2xl text-2xl">Save</button>
                <button id="deleteUser" type="button" style="color:white;background-color:red;padding:0.5rem;">Delete</button>
            </form>
            <br>
             <table>
                <thead>
                    <tr><th colspan="5" class="border p-2">Anggota</th></tr>
                    <tr>
                        <th class="border p-2">Periode</th>
                        <th class="border p-2">Divisi</th>
                        <th class="border p-2">Role</th>
                        <th class="border p-2">Display Photo</th>
                        <th class="border p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
            `;

            (user.members).forEach(e => {
                let div ='';
                console.log(e);
              
                divisionOption.forEach(element => {
                    if(element === e.division){ div += `<option value="${element}"selected>${element}</option>\n`;}
                    else{ div += `<option value="${element}">${element}</option>\n`;}
                });

                let role ='';
                if(e.division == "BPH"){
                    roleBPH.forEach(element =>{
                        if(e.role == element){role += `<option value="${element}"selected>${element}</option>\n`;}
                        else{ role += `<option value="${element}">${element}</option>\n`;}
                    });
                }else{
                    roleReg.forEach(element =>{
                        if(e.role == element){role += `<option value="${element}"selected>${element}</option>\n`;}
                        else{ role += `<option value="${element}">${element}</option>\n`;}
                    });
                }

                formEditUser +=
                `<tr class="member-row" data-id="${e.id}">
                    <td class="border p-2">
                        <input type="number" name="periode" value="${e.period}" required>
                    </td>
                    <td class="border p-2">
                        <select name="division" class="division" data-id="${e.id}" required>
                            ${div}
                        </select>
                    </td>
                    <td class="border p-2">
                        <select name="role" class="role" data-id="${e.id}" required>
                            ${role}
                        </select>    
                    </td>
                    <td class="border p-2">
                        <p>Current photo: ${e.display_photo}</p>
                        <input type="file" name="photo" accept="image/*" class="border-b">
                    </td>
                    <td class="border p-2">
                        <button type="button" class="btnEditMember">Edit</button> | 
                        <button type="button" class="btnDeleteMember">Delete</button>
                    </td>
                </tr>`;
            });
                        
            formEditUser += `
            <tr id="newMember">
                <td colspan="5" class="border">
                    <p class="text-2xl underline text-center">TAMBAH DATA MEMBER</p>
                </td>
            </tr>
            </tbody></table>`;

            $('#tableUsers').attr("hidden",true);
            $('#editDataUser').removeAttr('hidden');
            $('#editDataUser').html(formEditUser);
        }
    });
});

$('#editDataUser').on('change', '.division', function () {
    let div = $(this).val();
    let id = $(this).data('id');
    let role = '';
    if(div == "BPH"){
        roleBPH.forEach(element =>{
            role += `<option value="${element}">${element}</option>\n`;
        });
    }else{
        roleReg.forEach(element =>{
             role += `<option value="${element}">${element}</option>\n`;
        });
    }
    $(`.role[data-id="${id}"]`).html(role);
});

let newMemberCount = 0;
$('#editDataUser').on('click', '#newMember', function(){
    let div = '';

    divisionOption.forEach(element => {
         div += `<option value="${element}">${element}</option>\n`;
    });

    $(this).before(
        `<tr class="member-row" data-id="new${newMemberCount}">
                    <td class="border p-2">
                        <input type="number" name="periode" required>
                    </td>
                    <td class="border p-2">
                        <select name="division" class="division" data-id="new${newMemberCount}" required>
                            <option value="" disabled selected hidden>pilih divisi</option>
                            ${div}
                        </select>
                    </td>
                    <td class="border p-2">
                        <select name="role" class="role" data-id="new${newMemberCount}" required>
                            <option value="" disabled selected hidden>pilih divisi dulu</option>
                        </select>    
                    </td>
                    <td class="border p-2">
                        <input type="file" name="photo" accept="image/*" class="border-b">
                    </td>
                    <td class="border p-2">
                        <button type="button" class="btnSaveMember">Save</button>
                    </td>
                </tr>`
    );
    newMemberCount++;
});

$('#editDataUser').on('click', '#saveUser', function(e){
    e.preventDefault();
    let formData = $(this).closest('form').serializeArray().reduce((obj,i)=>{
        obj[i.name] = i.value;
        return obj;
    },{});
    console.log(formData);

    let sessionId  = $('meta[name="session-id"]').attr('content');
    let usrConfirm = confirm("Beneran mau update data nih 👉👈");

    if(usrConfirm){
        $.ajax({
            type: "PATCH",
            url: `/dashboard/editMember/user/by?id=${user.id}`,
            data: JSON.stringify(formData),
            dataType: "json",
            headers:{
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Content-Type': 'application/json'
            },
            success: function (response) {
                if(response === true){
                    alert("Data update success!!");
                    window.location.replace("/dashboard/editMember");
                }
            },
            error: function(xhr) {
            console.log('Error:', xhr.responseText);
            }
        });
    }else{
        window.location.replace("/dashboard/editMember");
    }
});

$('#editDataUser').on('click', '#deleteUser', function(e){
    e.preventDefault();
    let formData = $(this).closest('form').serializeArray().reduce((obj,i)=>{
        obj[i.name] = i.value;
        return obj;
    },{});
    console.log(formData);

    let sessionId  = $('meta[name="session-id"]').attr('content');
    let usrConfirm = confirm(`Beneran mau delete data ${formData.username} nih 😢`);
    let usrConfirm2= confirm(
        `Yakin nih bang ? coba check dulu :
        ID        = ${user.id}
        Full Name = ${formData.fullname}
        Username  = ${formData.username}
        NRP       = ${formData.nrp}
        Email     = ${formData.email}`);
    
    if(usrConfirm && usrConfirm2){
        $.ajax({
            type: "DELETE",
            url: `/dashboard/editMember/user/by?id=${user.id}`,
            data: JSON.stringify(formData),
            dataType: "json",
            headers:{
                'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                'Content-Type': 'application/json'
            },
            success: function (response) {
                if(response.status === true){
                    alert(`Delete Data success!!`);
                    window.location.replace("/dashboard/editMember");
                }
            },
            error: function(xhr) {
            console.log('Error:', xhr.responseText);
            }
        });
    }
});

$(document).on("click", ".btnEditMember", function (e) {
    e.preventDefault();

    let usrConfirm = confirm("Beneran mau update data nih 👉👈");
    if(!usrConfirm) return 0;

    let $row = $(this).closest('.member-row');
    let memberId = $row.data('id');

    let fData = new FormData();
    fData.append('_method', 'PATCH');
    fData.append('periode', $row.find('input[name="periode"]').val());
    fData.append('division', $row.find('select[name="division"]').val());
    fData.append('role', $row.find('select[name="role"]').val());

    let photoFile = $row.find('input[name="photo"]')[0].files[0];
    if (photoFile) {
        fData.append('photo', photoFile);
    }

    $.ajax({
        type: "POST",
        url: `/dashboard/editMember/by?member-id=${memberId}`,
        data: fData,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (res) {
            alert(res.status);
            console.log(res);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$(document).on("click", ".btnSaveMember", function (e) {
    e.preventDefault();

    let $row = $(this).closest('.member-row');
    let fData = new FormData();2025
    fData.append('periode', $row.find('input[name="periode"]').val());
    fData.append('division', $row.find('select[name="division"]').val());
    fData.append('role', $row.find('select[name="role"]').val());
    fData.append('usrId', `${user.id}`);

    let photoFile = $row.find('input[name="photo"]')[0].files[0];
    if (photoFile) {
        fData.append('photo', photoFile);
    }

    $.ajax({
        type: "POST",
        url: `/dashboard/editMember/new`,
        data: fData,
        dataType: "json",
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (res) {
            alert(res.status);
            console.log(res);
            // location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$(".memberSelector").on("change", function(){
    let tahun = $("#tahun").val();
    let divisi= $("#divisi").val();

    window.location.href = `/dashboard/editMember?periode=${tahun}&divisi=${divisi}`;
});
</script>
@endsection