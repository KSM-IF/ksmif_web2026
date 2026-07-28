@extends('layout.app')

@section('content')
<div class="font-['Jersey10']">
    <div class="text-center">
        <h1 class="text-7xl">Meet Our Team</h1>
        <p class="text-3xl sm:mx-[5%] mx-2">We are comprised of dedicated departments working together to build an amazing community.</p>
    </div>

    <form action="/our-team/by" method="GET" id="menuSelect" class="grid sm:grid-cols-4 grid-cols-2 place-items-center mx-auto pb-2 border-dashed border-4 rounded-2xl lg:w-[60%] w-[90%] sm:my-12 my-8 backdrop-blur-sm">
        <div class="text-center xl:text-4xl text-2xl">
            <select name="period" id="priod" onchange="this.form.submit()" class="underline">
                @foreach ($data['period'] as $i)
                    <?php $val=""; ?>
                    @if(isset($data['selectedItem']['period']) && $i==$data['selectedItem']['period']){
                        <?php $val = 'selected';?>
                    }
                    @endif
                  <option value={{$i}} {{$val}}>{{$i}}</option>
                @endforeach
            </select>
            <p>Periode</p>
        </div>
        
        <div class="text-center xl:text-4xl text-2xl">
            <select name="division" id="division" onchange="this.form.submit()" class="underline">
                @foreach ($data['division'] as $i)
                    <?php $val=""; ?>
                    @if(isset($data['selectedItem']['division']) && $i==$data['selectedItem']['division'])
                        <?php $val = 'selected';?>
                    @endif
                    <option value={{$i}} {{$val}}>{{$i}}</option>
                @endforeach
            </select>
            <p>Division</p>
        </div>

        <div class="text-center xl:text-4xl text-2xl">
            <p class="sm:text-4xl text-3xl">{{$data['totalMembers']}}</p>
            <p>Total Members</p>
        </div>

        <div class="text-center xl:text-4xl text-2xl">
            <p class="sm:text-4xl text-3xl">5</p>
            <p>Total Division</p>
        </div>
    </form>

    <div class="text-center my-5">
            @foreach ($data['member'] as $key => $item)
                <div class="sm:p-4 p-0.5 bg-black border lg:w-[40%] w-[90%] text-white mx-auto">
                @switch($key)
                    @case('bph')
                        <p class="sm:text-6xl text-5xl">BPH</p>
                        <p class="text-3xl">Badan Pengurus Harian</p>
                        @break
                    @case('ird')
                        <p class="sm:text-6xl text-5xl">IRD</p>
                        <p class="text-3xl">Internal Relation Department</p>
                        @break
                    @case('prd')
                        <p class="sm:text-6xl text-5xl">PRD</p>
                        <p class="text-3xl">Public Relation Department</p>
                        @break
                    @case('hrdd')
                        <p class="sm:text-6xl text-5xl">HRDD</p>
                        <p class="sm:text-3xl text-2xl">Human Resource Development Department</p>
                        @break
                    @case('cdd')
                        <p class="sm:text-6xl text-5xl">CDD</p>
                        <p class="text-3xl">Creative Design Department</p>
                        @break
                @endswitch
                </div>
                
                <div class="grid grid-cols-[repeat(2,auto)] min-[740px]:grid-cols-[repeat(3,auto)] min-[970px]:grid-cols-[repeat(4,auto)] xl:grid-cols-[repeat(6,auto)] justify-center gap-4 lg:mx-8 mx-2 my-4" id="members">
                    @foreach($item as $i)
                    <div class="border-2 border-dashed p-2 rounded-2xl max-w-56 min-w-44 max-h-[350px] backdrop-blur-sm">
                        <p class="text-6xl">{{$i['division']}}</p>
                        <p class="text-4xl">{{$i['role']}}</p>
                        @if(is_null($i['display_photo']))
                        <p class="text-8xl">&quest;</p>
                        @else
                        <img src="{{$i['display_photo']}}" alt="member_photo">
                        @endif
                        <p class="sm:text-4xl text-3xl">{{$i['full_name']}}</p>
                    </div>
                    @endforeach
                </div>
            @endforeach
    </div>
</div>
@endsection