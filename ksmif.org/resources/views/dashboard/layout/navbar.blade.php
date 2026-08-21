<nav class="left-0 float-left w-48 mx-2">
<p>Hi met datang {{$data['userLogin']['username']}}!!</p>
<p>Auth: {{$auth}}</p>
<a href="/dashboard/editMember/user/by?id={{$data['userLogin']['id']}}">&#x21A3; Edit Profile</a><br>
@if ($auth == 'superAdmin')
    <a href="/dashboard/editMember">&#x21A3; Edit Member</a><br>
    <a href="/dashboard/newMember">&#x21A3; Tambah User/Member</a><br>
    <a href="/dashboard/editBursa">&#x21A3; bursa soal</a><br>
    <a href="/dashboard/database">&#x21A3; database</a><br>
@elseif($auth == 'koor')
    <a href="/dashboard/editMember">&#x21A3; Edit Member</a><br>
    <a href="/dashboard/newMember">&#x21A3; Tambah User/Member</a><br>
    <a href="/dashboard/editBursa">&#x21A3; bursa soal</a><br>
@elseif($auth == 'hrdd')
    <a href="/dashboard/editBursa">&#x21A3; bursa soal</a><br>
@endif
<a href="/">&#x21A3; homepage</a><br>
</nav>