@extends('dashboard.layout.layout')

@section('content')
<div id="editDataUser">
</div>

<script>
const user = @json($data['user']);
const divisionOption = ['BPH', 'IRD', 'PRD', 'HRDD', 'CDD'] ;
const roleBPH = ['Ketua','Wakil Ketua', 'Sekretaris', 'Bendahara'];
const roleReg = ['Koor', 'WaKoor', 'Anggota'];
let submitClick = false;
$(document).ready(function () {
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
        `<form action="/dashboard/editMember/by?user-id=${user.id}" method="POST" class="grid grid-cols-2">
            @csrf
            <section>
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
        </section>
        <section class="border m-4 p-2">
            <p>Ganti Password</p>
            <div>
                <label for="old-password">Old Password:</label>
                <input type="text" name="old-password" style="border-bottom: 1px black solid;">
            </div>
            <div>
                <label for="new-password">New Password:</label>
                <input type="text" name="new-password" style="border-bottom: 1px black solid;">
            </div>
            <div>
                <label for="confirm-password">Confirm Password:</label>
                <input type="text" name="confirm-password" style="border-bottom: 1px black solid;">
            </div>
            <p>*kalo lupa password contact BPH :v</p>
        </section>
        <div>
            <button id="saveUser" type="button" class="bg-black p-2 text-white rounded-2xl text-2xl">Save</button>
            <button id="deleteUser" type="button" style="color:white;background-color:red;padding:0.5rem;">Delete</button>
        </div>
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
                @if($auth == 'hrdd' || $auth == 'normies')
                <td class="border p-2">
                    <input type="number" name="periode" value="${e.period}" required disabled>
                </td>
                <td class="border p-2">
                    <select name="division" class="division" data-id="${e.id}" required disabled>
                        ${div}
                    </select>
                </td>
                <td class="border p-2">
                    <select name="role" class="role" data-id="${e.id}" required disabled>
                        ${role}
                    </select>    
                </td>
                @else
                <td class="border p-2">
                    <input type="number" name="periode" value="${e.period}" required >
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
                @endif
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
        @if($auth == 'hrdd' || $auth == 'normies')
            <tr id="newMember" hidden>
                <td colspan="5" class="border">
                    <p class="text-2xl underline text-center">TAMBAH DATA MEMBER</p>
                </td>
            </tr>
        @else
            <tr id="newMember">
                <td colspan="5" class="border">
                    <p class="text-2xl underline text-center">TAMBAH DATA MEMBER</p>
                </td>
            </tr>
        @endif
        </tbody></table>
        <p style="color:red">
            *tambah data member, ganti role divisi dan ganti periode hanya bisa dilakukan oleh KOORWA / BPH<br>
            Jangan lancang kau dek 🤨🫵
        </p>`;

        $('#editDataUser').html(formEditUser);
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
                console.log("Status:", xhr.status);
                console.log("Response:", xhr.responseJSON);

                alert(xhr.responseJSON?.message ?? "Terjadi kesalahan");
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

    let usrConfirm = false, usrConfirm1 = false, usrConfirm2 = false;
    let sessionId  = $('meta[name="session-id"]').attr('content');
    usrConfirm = confirm(`Beneran mau delete data ${formData.username} nih 😢`);
    if(usrConfirm){
    usrConfirm1= confirm(`
▖ ▗▖▗▄▖▄▖ ▖ ▗▖▄▄▖▖ ▗▖▗▄▄▐▌
▌ ▐▌▌ ▌▌▐▌▛▚▐▌ █ ▛▚▐▌▌  ▐▌
▌ ▐▌▛▜▌▛▚▖▌ ▜▌ █ ▌ ▜▌▌▝▜▐▌
▙█▟▌▌▐▌▌▐▌▌ ▐▌▄█▖▌ ▐▌▚▄▞▗▖
Data user dan seluruh data member dri user yg bersangkutan akan dihapus!`);
        if(usrConfirm1){
        usrConfirm2= confirm(`Yakin nih bang ? coba check dulu :
ID        = ${user.id}
Full Name = ${formData.fullname}
Username  = ${formData.username}
NRP       = ${formData.nrp}
Email     = ${formData.email}`);
        }
    }

    if(usrConfirm && usrConfirm2 && usrConfirm1){
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

$(document).on("click", ".btnDeleteMember", function (e) {
    e.preventDefault();
    if(submitClick){
        alert("SABAR ANYING MASIH UPDATE!!!\n😊");
        return 0;
    }
    submitClick = true;

    let usrConfirm = confirm("Beneran mau delete data nih 👉👈");
    if(!usrConfirm) return 0;

    let $row = $(this).closest('.member-row');
    let memberId = $row.data('id');

    $.ajax({
        type: "DELETE",
        url: `/dashboard/editMember/user/by?member-id=${memberId}`,
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val()
        },
        success: function (res) {
            alert(res.status);
            // console.log(res.status);
            location.reload();
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});

$(document).on("click", ".btnEditMember", function (e) {
    e.preventDefault();
    if(submitClick){
        alert("SABAR ANYING MASIH UPLOADD!!!\n😊");
        return 0;
    }
    submitClick = true;
    
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
        url: `/dashboard/editMember/user/by?member-id=${memberId}`,
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
            if (xhr.status === 403) {
                window.location.href = '/err?code=403';
            } else {
                console.error(xhr.responseText);
            }
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
            location.reload();
        },
        error: function (xhr, status, error) {
            if (xhr.status === 403) {
                window.location.href = '/err?code=403';
            } else {
                console.error(xhr.responseText);
            }
        }
    });
});
</script>
@endsection