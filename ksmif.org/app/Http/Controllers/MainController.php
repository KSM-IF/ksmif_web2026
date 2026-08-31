<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Members;
use App\Models\BursaSoal;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    function homepage(){
        $data=['navbar' => 'homepage', 'auth' => Auth::check()];
        if(Auth::check()) $data['usr-id'] = Auth::user()->id;
        return view('welcome', compact('data'));
    }

    private function sortingMember($input,&$target){
    $priority = [
        'Ketua'       => 0,
        'Koor'        => 0,
        'Wakil Ketua' => 1,
        'WaKoor'      => 1,
        'Sekretaris'  => 2,
        'Bendahara'   => 3,
        'Anggota'     => 4,
    ];
    $target[] = $input;
    usort($target, function($a, $b) use ($priority){
        return ($priority[$a['role']] ?? 99) <=> ($priority[$b['role']] ?? 99);
    });
}

    function getMember(){
        try{
        $now = (time() <= strtotime('01-09-2026')) ? '2025':'2026';
        $member      = User::join('members', 'users.id', '=', 'members.users_id')
                           ->where('period', $now) 
                           ->get();
        if($member->isEmpty())throw new Exception('',400);

        $BPH=[];$IRD=[];$PRD=[];$HRDD=[];$CDD=[];
        foreach($member as $item){
            switch($item['division']){
                case "BPH":
                    $this->sortingMember($item,$BPH);
                    break;
                case "IRD":
                    $this->sortingMember($item,$IRD);
                    break;
                case "PRD":
                    $this->sortingMember($item,$PRD);
                    break;
                case "HRDD":
                    $this->sortingMember($item,$HRDD);
                    break;
                case "CDD":
                    $this->sortingMember($item,$CDD);
                    break;
            }
        }

        $allPeriode  = Members::pluck('period')->unique()->toArray();
        $allDivision = ['ALL','BPH', 'IRD', 'PRD', 'HRDD', 'CDD'];
        $totalMember = $member->count();

        $data=['navbar'     => 'ourTeam',
               'period'     => $allPeriode,
               'division'   => $allDivision,
               'totalMembers'=> $totalMember,
               'auth'     => Auth::check(),
               'member'   => [
                'bph' => $BPH,
                'ird' => $IRD,
                'prd' => $PRD,
                'hrdd'=> $HRDD,
                'cdd' => $CDD
            ]];
        if(Auth::check()) $data['usr-id'] = Auth::user()->id;
        }catch(Exception $ex){
            $data=['err'=> $ex->getMessage()];
            return view("errors.{$ex->getCode()}");
        }
        // return response()->json($data);
        return view('ourTeam', compact('data'));
    }

    function getMemberBy(Request $req){
        try{
        $period   = $req->query('period');
        $division = $req->query('division');
        
        if($division === 'ALL'){
            $member = User::join('members', 'users.id', '=', 'members.users_id')
                          ->where('period', $period) 
                          ->get();
            if($member->isEmpty())throw new Exception('',400);

            $BPH=[];$IRD=[];$PRD=[];$HRDD=[];$CDD=[];
            foreach($member as $item){
                switch($item['division']){
                    case "BPH":
                        $this->sortingMember($item,$BPH);
                        break;
                    case "IRD":
                        $this->sortingMember($item,$IRD);
                        break;
                    case "PRD":
                        $this->sortingMember($item,$PRD);
                        break;
                    case "HRDD":
                        $this->sortingMember($item,$HRDD);
                        break;
                    case "CDD":
                        $this->sortingMember($item,$CDD);
                        break;
                }
            }

            $member =[
                'bph' => $BPH,
                'ird' => $IRD,
                'prd' => $PRD,
                'hrdd'=> $HRDD,
                'cdd' => $CDD
            ];

        }else{
            $member = User::join('members', 'users.id', '=', 'members.users_id')
                           ->where('period', $period)
                           ->where('division', $division)
                           ->get();
            if($member->isEmpty())throw new Exception('',400);
            $temp = [];
            foreach($member as $i){
                $this->sortingMember($i,$temp);
            }
            $member = [ strtolower($division) => $temp];
        }
        

        $allPeriode  = Members::pluck('period')->unique()->toArray();
        $allDivision = ['ALL','BPH', 'IRD', 'PRD', 'HRDD', 'CDD'];
        $totalMember = Members::where('period', $period)->count();
        
        $data=['navbar'      => 'ourTeam',
               'period'      => $allPeriode,
               'division'    => $allDivision,
               'totalMembers'=> $totalMember,
               'member'      => $member,
               'auth'        => Auth::check(),
               'selectedItem'=> [
                    'period'  => $period,
                    'division'=> $division
               ]
            ];
        if(Auth::check()) $data['usr-id'] = Auth::user()->id;

        }catch(Exception $ex){
            $data=['err'=> $ex->getMessage()];
            return view("/errors.{$ex->getCode()}");
        }
        // return response()->json($data);
        return view('ourTeam', compact('data'));
    }

    function gallery(){
        try{
            $data = ['navbar' => 'gallery', 'auth' => Auth::check()];
            if(Auth::check()) $data['usr-id'] = Auth::user()->id;
            
            return view('galleryProker', compact('data'));
        }catch(Exception $ex){
            $data=['err'=> $ex->getMessage()];
            return view("/errors.{$ex->getCode()}");
        }
    }
    
    function error(Request $req){
        $code = $req->query('code');
        return view("/errors.{$code}");
    }

    function database(){
        $data = ['auth' => Auth::check()];
        return view('dashboard.adminer', compact('data'));
    }
}
