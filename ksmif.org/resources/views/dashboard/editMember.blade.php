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
$('.edit-btn').click(function (e) { 
    e.preventDefault();
    let id = $(this).data('id');
    window.location.href = "/dashboard/editMember/user/by?id="+id; 
});

$(".memberSelector").on("change", function(){
    let tahun = $("#tahun").val();
    let divisi= $("#divisi").val();

    window.location.href = `/dashboard/editMember?periode=${tahun}&divisi=${divisi}`;
});
</script>
@endsection